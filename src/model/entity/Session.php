<?php

namespace Birdy\Model\Entity;

use Etsik\Core\DateTimeFrench;
use Etsik\Core\BaseEntity;

class Session extends BaseEntity
{    

    private $id;
    private $name;
    private $description;
    private $date;
    private $start;
    private $end;
    private $agenda;
    private $report;
    private $step;
    private $user;
    private $classroom;
    private $cycle;
    private $userId;
    private $classroomId;
    private $cycleId;
    private $classroomName;
    private $presencesData;
    private $skills;
    private $nbSkills;

    public function getManagerEntity()
    {
        return "SessionManager";
    }

    /**
    * Converts the entity in an array
    */
    public function toArray()
    {
        $objectArray = get_object_vars($this);
        return $objectArray;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of start
     */ 
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @return  self
     */ 
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     */ 
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @return  self
     */ 
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get the value of agenda
     */ 
    public function getAgenda()
    {
        return $this->agenda;
    }

    /**
     * Set the value of agenda
     *
     * @return  self
     */ 
    public function setAgenda($agenda)
    {
        $this->agenda = $agenda;

        return $this;
    }

    /**
     * Get the value of report
     */ 
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set the value of report
     *
     * @return  self
     */ 
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }

    /**
     * Get the value of step
     */ 
    public function getStep()
    {
        return $this->step;
    }

    /**
     * Set the value of step
     *
     * @return  self
     */ 
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of cycle
     */ 
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set the value of cycle
     *
     * @return  self
     */ 
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get the value of classroom
     */ 
    public function getClassroom()
    {
        return $this->classroom;
    }

    /**
     * Set the value of classroom
     *
     * @return  self
     */ 
    public function setClassroom($classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

   

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of classroomId
     */ 
    public function getClassroomId()
    {
        return $this->classroomId;
    }

    /**
     * Set the value of classroomId
     *
     * @return  self
     */ 
    public function setClassroomId($classroomId)
    {
        $this->classroomId = $classroomId;

        return $this;
    }

    /**
     * Get the value of cycleId
     */ 
    public function getCycleId()
    {
        return $this->cycleId;
    }

    /**
     * Set the value of cycleId
     *
     * @return  self
     */ 
    public function setCycleId($cycleId)
    {
        $this->cycleId = $cycleId;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getStartDate() {
        return new DateTimeFrench($this->getStart());
    }

    public function getEndDate() {
        return new DateTimeFrench($this->getEnd());
    }

    public function getDateDate() {
        return new DateTimeFrench($this->getDate());
    }


    /**
     * Get the value of classroomName
     */ 
    public function getClassroomName()
    {
        return $this->classroomName;
    }

    /**
     * Set the value of classroomName
     *
     * @return  self
     */ 
    public function setClassroomName($classroomName)
    {
        $this->classroomName = $classroomName;

        return $this;
    }

    public function setPresencesData($datas) {
        $this->presencesData = $datas;
    }

    public function getPresencesData() {
        return $this->presencesData;
    }

    /**
     * Get the value of skills
     */ 
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set the value of skills
     *
     * @return  self
     */ 
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get the value of nbSkills
     */ 
    public function getNbSkills()
    {
        return $this->nbSkills;
    }

    /**
     * Set the value of nbSkills
     *
     * @return  self
     */ 
    public function setNbSkills($nbSkills)
    {
        $this->nbSkills = $nbSkills;

        return $this;
    }
}