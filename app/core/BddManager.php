<?php

namespace Etsik\Core;

use Etsik\Model\Manager\UserManager;
use Etsik\Core\BaseBddManager;

abstract class BddManager extends BaseBddManager
{

    abstract public function getTableName();

    abstract public function getEntityName();

    abstract public function getOrderDefault();

    abstract public function hasFlagData();

    abstract public function hasUserSession();

 
    /**
     * Persist object in Bdd
     *
     * @param [Object] $manager
     * @param [string] $setString
     * @param [string] $bindString
     * @return Object
     */
    private function persist($manager, $nspace) {

        $object     = $manager->getObject();
        $setString  = $this->createSetString($manager);
        $bindString = $this->createBindString($manager);

        if($object->getId()) {
            $object = $this->update($this, $setString, $bindString, $nspace);
        } else {
            $object = $this->insert($this, $setString, $bindString, $nspace);
        }
        return $object;
    }

    public function save($nspace = null) {

        $object = $this->persist($this, $nspace);
        return $object;  
    }

    public function unJoinEntitys($id, $join_table, $target_table) {
        $query = " DELETE FROM ".$join_table." WHERE ".$target_table."_id = ".$id;
        $stmt = $this->prepare($query);
        $stmt->execute();
    }

    public function joinEntitys($element1, $element2, $table1, $table2, $hasFlagData = false) {

        (is_object($element1)) ? $element_id_1 = $element1->getId() : $element_id_1 = $element1;
        (is_object($element2)) ? $element_id_2 = $element2->getId() : $element_id_2 = $element2;

        $target_table = $table1.'_'.$table2;
        $query = " INSERT INTO ".$target_table." SET ".$table1."_id = ".$element_id_1." ,  ".$table2."_id = ".$element_id_2."  ";

        if($hasFlagData) {
            $currentDate = date('Y-m-d H:i:s');
            $userSessionName = $this->session->getUserName();
            $query .=  " , created_by = '".$userSessionName."', created_at = '".$currentDate."', updated_at = '".$currentDate."', updated_by = '".$userSessionName."' ;";
        }

        $stmt = $this->prepare($query);
        
        if(!$stmt->execute()) {
            dd($stmt->errorInfo());
        }   
        
    }
   
    /**
     * Undocumented function
     *
     * @param [int] $id
     * @param [string] $targetEntityName
     * @param [string] $linkEntityName
     * @param [string] $join_table
     * @return Array
     */
    public function retrieveJoinEntitys($id, $targetEntityName, $linkEntityName, $join_table, $nspace = null) {

        $target_table = strtolower($targetEntityName);
        $join_name = $target_table.'_id';
        $link_name = strtolower($linkEntityName).'_id';

        $query = "  SELECT * FROM ".$target_table." as t 
                    LEFT JOIN ".$join_table." as j ON j.".$join_name." = t.id  
                    WHERE ".$link_name." = ".$id;

        $stmt = $this->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$targetEntityName;

        foreach ($datas as $data) {

            $object = new $entity($data);
            $objects[] = $object;
        }

        return $objects;
    }


   
    /**
     * Undocumented function
     *
     * @param [int] $id
     * @param [string] $nspace
     * @return Object
     */
    public function find($id, $nspace = null)
    {
        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT * FROM '.$table.' WHERE id = :id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$entity;

        if($this->hasUserSession()) {
            $userManager = new UserManager();
            $user = $userManager->find($this->session->getUserId(), 'Etsik');
        }

        $object = new $entity($data);
        if($this->hasUserSession()) $object->setUser($user);

        return $object;
    }


    public function findAll($order_by = null, $nspace = null)
    {

        if(!$order_by) $order_by = $this->getOrderDefault();

        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT * FROM '.$table;
        $query .= ' ORDER BY '.$order_by;
        $stmt = $this->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$entity;
        
        $user_id = null;
        $userManager = new UserManager();

        foreach ($datas as $data) {
            $object = new $entity($data);

            if($this->hasUserSession()) {
                if($object->getUserId() != $user_id) {
                    $user = $userManager->find($this->session->getUserId(), 'Etsik');
                    $user_id = $user;
                } 
                if($user) $object->setUser($user);
            }
            $objects[] = $object;
        }

        return $objects;
    }

    public function findByUserSession($order_by = null, $nspace = null)
    {

        if(!$order_by) $order_by = $this->getOrderDefault();

        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT * FROM '.$table;
        if($this->hasUserSession()) $query .= ' WHERE user_id = '.$this->session->getUserId(); 
        $query .= ' ORDER BY '.$order_by;
        $stmt = $this->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$entity;

        if($this->hasUserSession()) {
            $userManager = new UserManager();
            $user = $userManager->find($this->session->getUserId(), 'Etsik');
        }

        foreach ($datas as $data) {
            $object = new $entity($data);
            if($this->hasUserSession()) $object->setUser($user);
            $objects[] = $object;
        }

        return $objects;
    }


    public function findBy($criterias, $order_by = null, $nspace = null) {

        if(!$order_by) $order_by = $this->getOrderDefault();

        $table = $this->getTableName();
        $entity = $this->getEntityName();
        $query = 'SELECT * FROM '.$table;

        $query .= " WHERE 1=1 ";
        foreach($criterias as $criteria => $value) {
            $query .= " AND ".$criteria." = '".$value."' ";
        }

        $query .= ' ORDER BY '.$order_by;
;
        $stmt = $this->prepare($query);
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(!$nspace) $nspace = NSPACE;

        $entity = $nspace."\Model\Entity\\".$entity;

        if($this->hasUserSession()) {
            $userManager = new UserManager();
            $user = $userManager->find($this->session->getUserId(), 'Etsik');
        }

        $objects = [];
        foreach ($datas as $data) {
            $object = new $entity($data);
            if($this->hasUserSession()) $object->setUser($user);
            $objects[] = $object;
        }

        return $objects;
    }

    public function delete($objectId)
    {
        $tableName = $this->getTableName();
        $query = ' DELETE FROM '.$tableName.' WHERE id = :id';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':id', $objectId);
        $stmt->execute();

        return true;
    }

    public function getResultBySlug($slug_name, $field = "slug")
    {
        $query = 'SELECT * FROM '.$this->getTableName().' WHERE '.$field.' = :slug';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':slug', $slug_name);
        $stmt->execute();
        if (!$result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            return null;
        }

        return $result;
    }
}
