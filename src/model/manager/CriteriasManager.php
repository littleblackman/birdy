<?php
namespace Birdy\Model\Manager;
use Etsik\Core\BddManager;
use Birdy\Model\Entity\Criterias;

class CriteriasManager extends BddManager {

    protected $fields = ['name', 'description', 'type', 'values', 'entries'];

    public function getTableName()
    {
        return 'criterias';
    }

    public function getEntityName()
    {
        return 'Criterias';
    }

    public function getOrderDefault()
    {
        return 'name ASC';
    }

    public function hasFlagData()
    {
        return false;
    }

    public function hasUserSession() 
    {
        return false;
    }

   
  
        
}