<?php

namespace Etsik\Core;

use Etsik\Core\FlashMessage;

class Session
{
    private $titlePage;
    private $descriptionPage;

    public function initUserSession($user)
    {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['auth'] = 1;
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['initials'] = $user->getInitials();
        $_SESSION['access'] = $user->getAccessArray();
        $_SESSION['fullname'] = $user->getFullname();
        

        // add cookie
        $identifiant = base64_encode($user->getEmail().'('.NSPACE.')'.$user->getPassword());
        setcookie('identifiant', $identifiant, time() + 365 * 24 * 3600, null, null, false, true);
    }

    public function getRole()
    {
        return $_SESSION['role'];
    }

    public function destroy()
    {
        session_destroy();
        unset($_COOKIE['identifiant']);
        setcookie('identifiant', '', 1);
    }

    public function isLogged()
    {
        if ($this->getAuth() != 1) {
            return false;
        }

        return true;
    }

    public function getAuth()
    {
        if (!isset($_SESSION['auth'])) {
            return null;
        }

        return $_SESSION['auth'];
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getUsername()
    {
        if(!isset($_SESSION['username'])) return null;
        return $_SESSION['username'];
    }

    public function getFullname() {
        return $_SESSION['fullname'];
    }

    public function getInitials()
    {
        return $_SESSION['initials'];
    }

    public function getUserId()
    {
        return $_SESSION['user_id'];
    }

    public function setFlashMessage($message, $type)
    {
        $_SESSION['flashMessage'][] = ['message' => $message, 'type' => $type];
    }

    public function getAccess()
    {
        if (!isset($_SESSION['access'])) {
            return [];
        }

        return $_SESSION['access'];
    }

    public function getDescriptionPage()
    {
        if (!$this->descriptionPage) {
            return DEFAULT_PAGE_DESCRIPTION;
        }

        return $this->descriptionPage;
    }

    public function getTitlePage()
    {
        if (!$this->titlePage) {
            return DEFAULT_PAGE_TITLE;
        }

        return $this->titlePage;
    }

    /**
     * Set the value of titlePage.
     *
     * @return self
     */
    public function setTitlePage($titlePage)
    {
        $this->titlePage = $titlePage;

        return $this;
    }

    /**
     * Set the value of descriptionPage.
     *
     * @return self
     */
    public function setDescriptionPage($descriptionPage)
    {
        $this->descriptionPage = $descriptionPage;

        return $this;
    }
}
