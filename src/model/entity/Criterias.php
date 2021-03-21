<?php

namespace Birdy\Model\Entity;

use Etsik\Core\BaseEntity;

class Criterias extends BaseEntity
{    

    private $id;
    private $name;
    private $type;
    private $values;
    private $entries;
    private $description;
  

    public function getManagerEntity()
    {
        return "CriteriasManager";
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

    /**
     * Get the value of values
     */ 
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set the value of values
     *
     * @return  self
     */ 
    public function setValues($values)
    {
        $this->values = unserialize($values);

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
}