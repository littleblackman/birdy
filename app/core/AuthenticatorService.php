<?php

namespace Etsik\Core;

use Etsik\Model\Entity\User;
use Etsik\Model\Manager\UserManager;

class AuthenticatorService
{
    private $session;
    private $userManager;

    /**
     * Undocumented function
     *
     * @param [type] $session
     */
    public function __construct($session) {
        $this->session = $session;
        $this->userManager = new UserManager();
    }

    public function autoconnect($email, $password) {
        if(!$user = $this->userManager->findByEmail($email)) return null;
        if($user->getPassword() != $password) return null;
        $this->session->initUserSession($user);
        return true;
    }

    public function auth($data) {

        if(!$user = $this->userManager->findByEmail($data['email'])) {
            $this->session->setFlashMessage('Email or password incorrect !', 'error');
            return false;
        }
        if(!password_verify($data['password'], $user->getPassword())) {
            $this->session->setFlashMessage('Email or password incorrect ;(', 'error');
            return false;
        } 
        $this->session->initUserSession($user);
        $this->session->setFlashMessage('Welcome on '.APP_NAME.' '.$user->getFullname(), 'success');

        return true;

    }

    public function create($data) {

        // test if email exist and if data is valid before persist

        $user = new User();
        $user->setFirstname($data['firstname']);
        $user->setLastname($data['lastname']);
        $user->setEmail($data['email']);
        $user->setRole($data['role']);
        $user->setUsername($this->userManager->generateSlug($data['firstname'].$data['lastname'], 'username'));
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));

        $user->save('Etsik');


    }
}