<?php

namespace Etsik\Core;

abstract class BaseEntity
{

    protected $createdAt;
    protected $createdBy;
    protected $updatedAt;
    protected $updatedBy;

    public function __construct($data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }

    abstract public function getManagerEntity();

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            $elements = explode('_', $key);
            $new_key = '';
            foreach ($elements as $element) {
                $new_key .= ucfirst($element);
            }
            $method = 'set'.$new_key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function save($nspace = null)
    {

        if(!$nspace) $nspace = NSPACE;

        $managerName = $this->getManagerEntity();
        $managerName = $nspace."\Model\Manager\\".$managerName;
        $manager = new $managerName();
        $manager->setObject($this);
        return $manager->save($nspace);
    }

    public function delete($nspace = null)
    {
        if(!$nspace) $nspace = NSPACE;

        $managerName = $this->getManagerEntity();
        $managerName = $nspace."\Model\Manager\\".$managerName;
        $manager = new $managerName();
        $manager->delete($this->getId(), $nspace);
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of createdBy
     */ 
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set the value of createdBy
     *
     * @return  self
     */ 
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of updatedBy
     */ 
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set the value of updatedBy
     *
     * @return  self
     */ 
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

  
}
