<?php

namespace Etsik\Core;

use Etsik\Core\Session;


abstract class BaseBddManager {

    private $bdd;
    protected $session;

    public function __construct()
    {
        $this->bdd = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_LOGIN, DB_PWD);
        $this->session = new Session();
    }

    /**
     * return PDO object with connexion
     *
     * @return PDO
     */
    protected function connexion()
    {
        return $this->bdd;
    }

    /**
     * Get connexion and return statement
     *
     * @param [string] $query
     * @return PDO
     */
    protected function prepare($query)
    {
        return $this->connexion()->prepare($query);
    }



    public function getFields(){
        return $this->fields;
    }

    /**
     * Get the value of object
     */ 
    protected function getObject()
    {
        return $this->object;
    }

    /**
     * Set the value of object
     *
     * @return  self
     */ 
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * create setString from $field list
     *
     * @return string
     */
    protected function createSetString($manager) {
        $string = "SET ";
        foreach($manager->fields as $field) {
            $elements[] = " ".$field." = :".$field." "; 
        }
        return $string.' '.implode(', ', $elements);
    }


    /**
     * create bindString from $field list
     *
     * @return string
     */
    protected function createBindString($manager) {
       
        $object = $manager->getObject();

        $bindString = [];

        foreach ($manager->getFields() as $field) {
            $elements = explode('_', $field);
            $new_key = '';
            foreach ($elements as $element) {
                $new_key .= ucfirst($element);
            }
            $method = 'get'.$new_key;

            if (method_exists($object, $method)) {
                $bindString[$field] = $object->$method();
            }
        }

        return $bindString;

    }

    protected function getLastInsertId()
    {
        return $this->connexion()->lastInsertId();
    }

    public function refreshObject($object, $nspace = null)
    {
        if ($object->getId()) {
            $object_id = $object->getId();
        } else {
            $object_id = $this->connexion()->lastInsertId();
        }
        $object = $this->find($object_id, $nspace);

        return $object;
    }

     /**
     * Create and prepare an Insert query
     *
     * @param [Object] $manager
     * @param [string] $string
     * @return PDO
     */
    protected function insert($manager, $string, $binds, $nspace = null) {

        $query = "INSERT INTO ".$manager->getTableName().' '.$string;
        if($manager->hasFlagData()) {
            $query .= ", created_by = :created_by, created_at = :created_at, updated_at = :updated_at, updated_by = :updated_by ";
        }

        if($manager->hasUserSession()) {
            $query .= " , user_id = ".$this->session->getUserId();
        }

  
        $stmt = $this->prepare($query);
        foreach($binds as $field => $value) {
            $stmt->bindValue(':'.$field, $value);
        }

        if($manager->hasFlagData()) {
            $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
            $stmt->bindValue(':created_by', $this->session->getUsername());
            $stmt->bindValue(':updated_by', $this->session->getUsername());
            $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'));
        };

        if(!$stmt->execute()) {
            dd($stmt->errorInfo());
        }       
        return $this->refreshObject($manager->getObject(), $nspace);

    }

    /**
     * Create and prepare an Update query
     *
     * @param [Object] $manager
     * @param [string] $string
     * @return Object
     */
    protected function update($manager, $string, $binds, $nspace = null) {

        $query = "UPDATE ".$manager->getTableName().' '.$string;
        if($manager->hasFlagData()) {
            $query .= " , updated_at = :updated_at, updated_by = :updated_by ";
        }

        $query .= " WHERE id = :id ";
  
        $stmt = $this->prepare($query);

        foreach($binds as $field => $value) {
            $stmt->bindValue(':'.$field, $value);
        }

        $stmt->bindValue(':id', $manager->getObject()->getId());

        if($manager->hasFlagData()) {
            $stmt->bindValue(':updated_by', $this->session->getUsername());
            $stmt->bindValue(':updated_at', date('Y-m-d H:i:s'));
        };

        if(!$stmt->execute()) {
            dd($stmt->errorInfo());
        }    
        
        return $this->refreshObject($manager->getObject(), $nspace);
    }

    public function generateSlug($name, $field = "slug")
    {
        $slug_name = str_replace([' ', ',', "'"], ['-', '-', '-'], $name);
        $slug_name = strtolower(
                            str_replace(
                                ['é', 'è', 'ê', 'ï', 'î', 'ë', 'à', 'ô', 'ö', 'â'],
                                ['e', 'e', 'e', 'i', 'i', 'e', 'a', 'o', 'o', 'a'],
                                $slug_name
        ));
        $i = 0;

        $original_name = $slug_name;
        if ($object = $this->getResultBySlug($slug_name, $field)) {
            $slug_object = $object['slug'];
            while ($slug_name == $slug_object) {
                ++$i;
                $slug_name = $original_name.'-'.$i;
                $object = $this->getResultBySlug($slug_name);
                ($object) ? $slug_object = $object['slug'] : $slug_object = '';
            }
        }

        return $slug_name;
    }



}