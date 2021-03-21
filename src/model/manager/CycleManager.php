<?php
namespace Birdy\Model\Manager;
use Etsik\Core\BddManager;

class CycleManager extends BddManager {

    protected $fields = ['name', 'description', 'start', 'end', 'step'];

    public function getTableName()
    {
        return 'cycle';
    }

    public function getEntityName()
    {
        return 'Cycle';
    }

    public function getOrderDefault()
    {
        return 'start ASC';
    }

    public function hasFlagData()
    {
        return true;
    }

    public function hasUserSession() 
    {
        return true;
    }


}