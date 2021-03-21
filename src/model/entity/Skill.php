<?php

namespace Birdy\Model\Entity;

use Etsik\Core\BaseEntity;

class Skill extends BaseEntity
{    

    private $id;
    private $name;
    private $category;
    private $description;
    private $criterias;
    private $entries;
    private $type;
    private $criteriasId;
    private $sessionId;
    private $session;
    private $agenda;
    private $sessionStart;
    private $sessionDate;
    private $sessionName;

    public function getManagerEntity()
    {
        return "SkillManager";
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
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

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
     * Get the value of criterias
     */ 
    public function getCriterias()
    {
        return $this->criterias;
    }

    /**
     * Set the value of criterias
     *
     * @return  self
     */ 
    public function setCriterias($criterias)
    {
        is_array($criterias) ? $criteriasArray = $criterias : $criteriasArray = unserialize($criterias);

        $this->criterias = $criteriasArray;

        return $this;
    }

    /**
     * Get the value of session
     */ 
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the value of session
     *
     * @return  self
     */ 
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get the value of sessionId
     */ 
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set the value of sessionId
     *
     * @return  self
     */ 
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

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
     * Get the value of sessionStart
     */ 
    public function getSessionStart()
    {
        return $this->sessionStart;
    }

    /**
     * Set the value of sessionStart
     *
     * @return  self
     */ 
    public function setSessionStart($sessionStart)
    {
        $this->sessionStart = $sessionStart;

        return $this;
    }

    /**
     * Get the value of sessionDate
     */ 
    public function getSessionDate()
    {
        return $this->sessionDate;
    }

    /**
     * Set the value of sessionDate
     *
     * @return  self
     */ 
    public function setSessionDate($sessionDate)
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    /**
     * Get the value of sessionName
     */ 
    public function getSessionName()
    {
        return $this->sessionName;
    }

    /**
     * Set the value of sessionName
     *
     * @return  self
     */ 
    public function setSessionName($sessionName)
    {
        $this->sessionName = $sessionName;

        return $this;
    }

    /**
     * Get the value of criteriaId
     */ 
    public function getCriteriasId()
    {
        return $this->criteriasId;
    }

    /**
     * Set the value of criteriaId
     *
     * @return  self
     */ 
    public function setCriteriasId($criteriaId)
    {
        $this->criteriasId = $criteriaId;

        return $this;
    }

    /**
     * Get the value of entries
     */ 
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * Set the value of entries
     *
     * @return  self
     */ 
    public function setEntries($entries)
    {
        $this->entries = unserialize($entries);

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}