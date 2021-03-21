<?php

namespace Birdy\Model\Entity;

use Etsik\Core\BaseEntity;

class Classroom extends BaseEntity
{

    private $id;
    private $name;
    private $description;
    private $user;
    private $cycles;
    private $students;

    public function getManagerEntity()
    {
        return "ClassroomManager";
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
     * Get the value of cycles
     */ 
    public function getCycles()
    {
        return $this->cycles;
    }

    /**
     * Set the value of cycles
     *
     * @return  self
     */ 
    public function setCycles($cycles)
    {
        $this->cycles = $cycles;

        return $this;
    }

    public function getCyclesIdList() {
        $ids = [];
        if($this->getCycles()) {
            foreach($this->getCycles() as $cycle) {
                $ids[$cycle->getId()] = $cycle->getId();
            }
        }
        return $ids;
    }

    /**
     * Get the value of students
     */ 
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Set the value of students
     *
     * @return  self
     */ 
    public function setStudents($students)
    {
        $this->students = $students;

        return $this;
    }

    public function getNbStudents() {
        return count($this->getStudents());
    }
}