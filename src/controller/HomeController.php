<?php

namespace Birdy\Controller;

use Etsik\Core\Controller;

class HomeController extends Controller
{
    

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        return $this->render('home/index');
    }

    public function dashboard()
    {
        return $this->render('home/dashboard');
    }

    public function register()
    {
        return $this->render('home/register');
    }

    public function login()
    {
        return $this->render('home/login');
    }

    public function mentions()
    {
        return $this->render('home/mentions');
    }
}
