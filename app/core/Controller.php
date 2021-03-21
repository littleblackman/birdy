<?php

namespace Etsik\Core;

use Etsik\Core\AuthenticatorService;
use Etsik\Core\Session;
use Etsik\Core\View;

abstract class Controller
{
    private $view;
    protected $request;
    protected $session;

    public function __construct($request)
    {
        // store request
        $this->request = $request;

        // créeate session
        $session = new Session();
        $session->setRequest($request);
        $this->session = $session;
        $this->view = new View($session);

        // check security and auth
        $this->checkAndInitApp();
    }

    public function pathTemplate($path)
    {
        $this->view->setPathTemplate($path);
    }

    public function render($template, $datas = [])
    {
        $myView = $this->view;
        $myView->setTemplate($template);
        $myView->render($datas);
    }

    public function renderHtml($template, $datas = [])
    {
        $this->view->setTemplate($template)->renderHtml($datas);
    }

    public function checkAndInitApp()
    {
        // check if user not logged, try to connect
        if ( !isset($this->session->isLogged) && !$this->session->isLogged()) {
            if (isset($_COOKIE['identifiant'])) {
                $identifiant = base64_decode($_COOKIE['identifiant']);
                $elements = explode('('.NSPACE.')', $identifiant);
                $email = $elements[0];
                $pwd = $elements[1];

                $authentificationService = new AuthenticatorService($this->session);
                if ($authentificationService->autoconnect($email, $pwd)) {
                    return $this->redirect($this->request->getRoute());
                } 
            }
        } 

        // check if user is authorized
        if (!$this->checkAccess()) {
           return  $this->redirect('index');
        }

        // if user logged redirect to the home private
        if ($this->request->getRoute() == '' && $this->session->isLogged()) {
            return $this->redirect('dashboard');
        }
    }

    public function checkAccess()
    {
        if ($this->request->getAccess() == 'public') {
            return true;
        }
        if (in_array($this->request->getAccess(), $this->session->getAccess())) {
            return true;
        }

        $this->session->setFlashMessage('You can\'t access to this page, sorry', 'warning');
        return false;
    }

    public function isOwner($object)
    {
        if ($this->session->getUserId() != $object->getOwnerId()) {
            return false;
        }

        return true;
    }

    /**
     * @params : string
     */
    public function redirect($route, $params = null)
    {
        $this->view->redirect($route, $params);
    }

    public function renderJson($datas)
    {
        echo json_encode($datas);
    }
}
