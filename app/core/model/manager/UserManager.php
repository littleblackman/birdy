<?php

namespace Etsik\Model\Manager;

use Etsik\Core\BddManager;
use Etsik\Core\Session;
use Etsik\Model\Validator\UserValidator;
use Etsik\Model\Entity\User;

class UserManager extends BddManager
{
 
    protected $fields = ['firstname', 'lastname', 'role', 'username', 'email', 'password', 'avatar_folder', 'avatar_filename'];

    public function getTableName()
    {
        return 'user';
    }

    public function getEntityName()
    {
        return 'User';
    }

    public function getOrderDefault()
    {
        return 'lastname ASC';
    }

    public function hasFlagData()
    {
        return true;
    }

    public function hasUserSession() 
    {
        return false;
    }

    public function __construct()
    {
        parent::__construct();
        $this->session = new Session();
        $this->userValidator = new UserValidator($this);
    }


    public function findByEmail($email)
    {
        $query = 'SELECT * FROM user WHERE email = :email';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            return null;
        }
        $user = new User($result);

        // add access role
        $query = 'SELECT * FROM user_role_access WHERE role = :role';
        $stmt = $this->prepare($query);
        $stmt->bindValue(':role', $user->getRole());
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($results as $r) {
            $user->addAccess($r['access']);
        }

        return $user;
    }


}
