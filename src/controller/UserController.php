<?php

namespace Birdy\Controller;

use Etsik\Core\AuthenticatorService;
use Etsik\Core\Controller;

class UserController extends Controller {

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function create() {
        $auth = new AuthenticatorService($this->session);
        $data = $this->request->get('data');
        $data['role'] = 'teacher';
        $auth->create($data);
        return $this->redirect('home');
    }

    public function auth() {
        $auth = new AuthenticatorService($this->session);
        if(!$auth->auth($this->request->get('data'))) return $this->redirect('home');
        return $this->redirect('dashboard');
    }

    public function logout() {

        $this->session->destroy();
        return $this->redirect('home');
    }




}