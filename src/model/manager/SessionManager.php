<?php
namespace Birdy\Model\Manager;
use Etsik\Core\BddManager;
use Etsik\Model\Manager\UserManager;
use Birdy\Model\Manager\ClassroomManager;
use Birdy\Model\Entity\Session;
use Etsik\Core\PaginationService;
use Birdy\Model\Entity\Skill;

class SessionManager extends BddManager {

    protected $fields = ['name', 'description', 'date', 'start', 'end', 'agenda', 'report', 'step', 'cycle_id', 'classroom_id'];

    public function getTableName()
    {
        return 'session';
    }

    public function getEntityName()
    {
        return 'Session';
    }

    public function getOrderDefault()
    {
        return 'date DESC';
    }

    public function hasFlagData()
    {
        return true;
    }

    public function hasUserSession() 
    {
        return true;
    }

    public function __construct() {
        parent::__construct();
        $this->classroomManager = new ClassroomManager();
    }

    public function findByUser($page = 1, $classroomId  = 'all', $stepSession = 'all', $cycleId = null, $limit = 20)
    {

        $criteria = 'user_id = '.$this->session->getUserId();

        if($classroomId != 'all') {
            $criteria .= ' and classroom_id = '.$classroomId;
        }

        if($stepSession != 'all') {
            $criteria .= ' and step = "'.$stepSession.'"';
        }

        if($cycleId) {
            $criteria .= ' and cycle_id = '.$cycleId.' ';
        }

        $pagination = new PaginationService($this, $limit, 'date desc, start desc ', $criteria, 'id');

        if($page == 0) $page = 1;
        if($page > $pagination->getNbPages()) $page = $pagination->getNbPages();
    
        $pagination->createCondition($page, 's');

        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT s.*, c.name as classroomName, count(sk.session_id) as nbSkills FROM '.$table.' s ';
        $query .= ' INNER JOIN classroom c ON c.id = s.classroom_id ';
        $query .= ' LEFT JOIN skill sk ON sk.session_id = s.id ';
        $query .=  $pagination->getCondition(); 
        $stmt = $this->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        NSPACE."\Model\Entity\\".$entity;

        $userManager = new UserManager();
        $user = $userManager->find($this->session->getUserId(), 'Etsik');
    

        foreach ($datas as $data) {
            $object = new Session($data);
            if($this->hasUserSession()) $object->setUser($user);
            $object->setNbSkills($data['nbSkills']);
            $objects[] = $object;
        }

        return [$objects, $pagination->getNbPages()];
    }

    /**
     * Undocumented function
     *
     * @param [int] $id
     * @param [string] $nspace
     * @return Object
    **/
    public function find($id, $nspace = null)
    {

        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT * FROM '.$table.' WHERE id = :id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$entity;

        if($this->hasUserSession()) {
            $userManager = new UserManager();
            $user = $userManager->find($this->session->getUserId(), 'Etsik');
        }

        $object = new $entity($data);
        if($this->hasUserSession()) $object->setUser($user);

        if($classroom = $this->classroomManager->find($object->getClassroomId())) {
            $object->setClassroom($classroom);
        }

        if($skills = $this->retrieveSkills($object->getId())) {
            $object->setSkills($skills);
        }

        $presences = $this->retrieveAllPresences($object->getId());
        $object->setPresencesData($presences);

        return $object;
    }

    public function openSessionAgain($id) {
        $query = ' UPDATE session set step = "open" WHERE id = :id ;';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }


    public function close($id) {
        $query = ' UPDATE session set step = "close" WHERE id = :id ;';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }


    public function retrievePresence($sessionId, $studentId) {
     
        $query = 'SELECT * FROM user_session WHERE session_id = :session_id and user_id = :student_id ';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $sessionId);        
        $stmt->bindValue(':student_id', $studentId);
        $stmt->execute();
        if(!$data = $stmt->fetch(\PDO::FETCH_ASSOC)) return false;

        return $data;
    }


    public function retrieveSkills($sessionId) {
     
        $query = 'SELECT * FROM skill WHERE session_id = :session_id ';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $sessionId);        
        $stmt->execute();

        if(!$datas = $stmt->fetchAll(\PDO::FETCH_ASSOC)) return false;

        foreach($datas as $data) {
            $skill = new Skill($data);
            $skills[] = $skill;
        }

        return $skills;
    }

    public function retrieveAllPresences($sessionId) {

        $query = 'SELECT user_id, status FROM user_session WHERE session_id = :session_id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $sessionId);        
        $stmt->execute();
        if(!$datas = $stmt->fetchAll(\PDO::FETCH_ASSOC)) return false;

        foreach($datas as $data) {
            $arr[$data['user_id']] = $data['status'];
        }

        return $arr;
    }

    public function updatePresence($sessionId, $studentId, $status) {

        if(!$link = $this->retrievePresence($sessionId, $studentId)) {
            $link = ['session_id' => $sessionId, 'user_id' => $studentId, 'status' => $status];
            $query = "INSERT INTO user_session SET session_id = :session_id, user_id = :student_id, status = :status";
        } else {
            $link['status'] = $status;
            $query = "UPDATE user_session SET status = :status WHERE session_id = :session_id AND user_id = :student_id ;";
        }

        if($link['status'] == "null"){
            $query = "DELETE FROM user_session WHERE session_id = :session_id AND user_id = :student_id ;";
        }

        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $link['session_id']);        
        $stmt->bindValue(':student_id', $link['user_id']);
        if($status != "null") $stmt->bindValue(':status', $link['status']);
         
        if(!$stmt->execute()) {
            dd($stmt->errorInfo());
        }   
        

        return $link;
    }

    public function deleteAll($session) {
        $query = 'DELETE FROM use_session WHERE session_id = :session_id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $session->getId());        
        $stmt->execute();

        $query = 'DELETE FROM skill WHERE session_id = :session_id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':session_id', $session->getId());        
        $stmt->execute();

        $session->delete();
    }

    public function getPresencesCheckPoints($classroom_id){

        $query = '  SELECT s.id as session_id, s.date, s.start, s.name, u.id as user_id,  u.firstname, u.lastname, us.status 
                    FROM session s 
                    LEFT JOIN user_session us ON us.session_id = s.id 
                    LEFT JOIN user u ON u.id = us.user_id 
                    WHERE s.classroom_id = :classroomId
                    AND step = "close" 
                    ORDER BY s.date DESC, start DESC, u.lastname asc, u.firstname asc';

        $stmt = $this->prepare($query);
        $stmt->bindValue('classroomId', $classroom_id);
        if(!$stmt->execute()) {
            dd($stmt->errorInfo());
        }   
        

        if(!$datas = $stmt->fetchAll(\PDO::FETCH_ASSOC)) return false;
        return $datas;

    }
    
        
}