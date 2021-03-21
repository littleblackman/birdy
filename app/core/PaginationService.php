<?php

namespace Etsik\Core;


class PaginationService extends BaseBddManager {

    private $manager;
    private $itemByPage;
    private $totalItems;
    private $nbPages;
    private $table;
    private $criteria;
    private $refId;
    private $condition;
    private $order;
    private $groupBy;


    public function __construct($manager, $itemByPage, $order = null, $criteria = ' 1 = 1 ', $groupBy = null) {

        parent::__construct();

        if($order == null) { 
            $this->order = $manager->getOrderDefault();
        } else {
            $this->order = $order;
        }

        $table = $manager->getTableName();
        $query = 'SELECT COUNT(*) FROM '.$table;
        $query .= ' WHERE '.$criteria;

        if($groupBy) $query .= " GROUP BY ".$groupBy;

        $stmt = $this->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        
        $this->itemByPage = $itemByPage;
        $this->totalItems = $result[0];
        $this->nbPages = ceil($this->totalItems/$itemByPage);
        $this->manager = $manager;
        $this->table = $table;
        $this->criteria = $criteria;
        $this->groupBy = $groupBy;
    }

    public function createCondition($page, $alias) {
        $first = ($page*$this->itemByPage) - $this->itemByPage;
        $condition = " WHERE ".$alias.".".$this->criteria ;
        if($this->groupBy) $condition .= " GROUP BY ".$alias.".".$this->groupBy." ";
        $condition .= ' ORDER BY '.$alias.".".$this->order.' LIMIT '.$first.','.$this->itemByPage;
        $this->condition = $condition;
    }

  
    /**
     * Get the value of totalItems
     */ 
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * Get the value of nbPages
     */ 
    public function getNbPages()
    {
        return $this->nbPages;
    }

    /**
     * Get the value of itemByPage
     */ 
    public function getItemByPage()
    {
        return $this->itemByPage;
    }

    /**
     * Get the value of manager
     */ 
    public function getManager()
    {
        return $this->manager;
    }


    /**
     * Get the value of refId
     */ 
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * Get the value of condition
     */ 
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Get the value of table
     */ 
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the value of groupBy
     */ 
    public function getGroupBy()
    {
        return $this->groupBy;
    }

    /**
     * Set the value of groupBy
     *
     * @return  self
     */ 
    public function setGroupBy($groupBy)
    {
        $this->groupBy = $groupBy;

        return $this;
    }
}
