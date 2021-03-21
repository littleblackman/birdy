<?php
namespace Birdy\Model\Manager;

use Etsik\Core\BddManager;
use Birdy\Model\Manager\CycleManager;

class ClassroomManager extends BddManager {

    protected $fields = ['name', 'description'];
    
    protected $cycleManager;

    public function __construct()
    {
        parent::__construct();
        $this->cycleManager = new CycleManager();
    }

    public function getTableName()
    {
        return 'classroom';
    }

    public function getEntityName()
    {
        return 'Classroom';
    }

    public function getOrderDefault()
    {
        return 'name ASC';
    }

    public function hasFlagData()
    {
        return true;
    }

    public function hasUserSession() 
    {
        return true;
    }

    public function joinCycles($classroom, $cycles) {

       $this->unJoinEntitys($classroom->getId(), 'classroom_cycle', 'classroom');

        foreach($cycles as $cycle) {
            (is_object($cycle)) ? $cycle_id = $cycle->getId() : $cycle_id = $cycle;
            $this->joinEntitys($classroom, $cycle_id, $this->getTableName(), 'cycle');
        }
    }

    public function joinUser($classroom, $user) {
        $this->joinEntitys($classroom, $user, 'classroom', 'user', true);
    }

    public function retrieveCycles($classroom_id) {

        $cycles = $this->retrieveJoinEntitys($classroom_id, "Cycle", "Classroom", "classroom_cycle");        
        return $cycles;
    }


    public function retrieveUsers($classroom_id) {

        $users = $this->retrieveJoinEntitys($classroom_id, "User", "Classroom", "classroom_user", 'Etsik');        
        return $users;
    }


    public function find($id, $nspace = null) {

        $classroom = parent::find($id, $nspace);

        if(!$classroom->getId()) return null;

        $cycles = $this->retrieveCycles($id);
        $users  = $this->retrieveUsers($id);

        $arr = [];
        if($users) {
            foreach($users as $user) {
                $arr[$user->getFullnameReverse()] = $user;
            }
            ksort($arr);
        }
        $classroom->setStudents($arr);

    
        $classroom->setCycles($cycles);

        return $classroom;

    }

    public function deleteAll($classroom) {
        $this->unJoinEntitys($classroom->getId(), 'classroom_cycle', 'classroom');
        $classroom->delete();
    }
}