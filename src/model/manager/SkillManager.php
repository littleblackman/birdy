<?php
namespace Birdy\Model\Manager;
use Etsik\Core\BddManager;
use Birdy\Model\Entity\Skill;

class SkillManager extends BddManager {

    protected $fields = ['name', 'description', 'criterias_id', 'session_id'];

    public function getTableName()
    {
        return 'skill';
    }

    public function getEntityName()
    {
        return 'Skill';
    }

    public function getOrderDefault()
    {
        return 'id ASC';
    }

    public function hasFlagData()
    {
        return true;
    }

    public function hasUserSession() 
    {
        return false;
    }


    public function findByClassroomId($classroomId) {

        $query = "  SELECT sk.*, ss.agenda, ss.date as session_date, ss.start as session_start, ss.name as session_name, ct.values as criterias, ct.entries as entries, ct.type as type 
                    FROM skill sk 
                    LEFT JOIN session ss ON sk.session_id = ss.id
                    LEFT JOIN criterias ct ON sk.criterias_id = ct.id
                    WHERE classroom_id = :classroomId
                    ORDER BY sk.criterias_id, ss.date ASC, ss.start ASC 
                    ;";
         $stmt = $this->prepare($query);
         $stmt->bindValue('classroomId', $classroomId);
         if(!$stmt->execute()) {
             dd($stmt->errorInfo());
         }   
    
         if(!$datas = $stmt->fetchAll(\PDO::FETCH_ASSOC)) return false;
         foreach($datas as $data) {
             $skill = new Skill($data);
             $skills[] = $skill;
         }

         return $skills;
    }


}