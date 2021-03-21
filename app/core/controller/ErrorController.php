<?php

namespace Etsik\Core;

class ErrorController extends Controller
{
    public function index404()
    {
        $this->pathTemplate(CORE.'template/');

        return $this->render('error404');
    }

    public function index403()
    {
        $this->pathTemplate(CORE.'template/');

        return $this->render('error403');
    }
}
