<?php

namespace Etsik\Core;

use Etsik\Core\Route;
use Etsik\Core\Request;
use Exception;

class Router
{
    private $request;

    private $routes;

    public function __construct()
    {
        
        ($_GET['r']) ? $action = $_GET['r'] : $action = '';

        $this->routes = Route::createRoutesArray();

        $route = $this->getRoute($action);

        if (key_exists($route, $this->routes)) {
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            if (isset($this->routes[$route]['vars'])) {
                $vars = explode('/', $this->routes[$route]['vars']); // id/date
            } else {
                $vars = [];
            }

            if (isset($this->routes[$route]['access'])) {
                $access = $this->routes[$route]['access'];
            } else {
                $access = 'public';
            }

            $params = $this->getParams($action, $vars);

            $namespace = "\\".NSPACE."\Controller\\";


            if(isset($this->routes[$route]['js'])) {
                $scriptJS = explode(' ', $this->routes[$route]['js']);
            } else {
                $scriptJS = null;
            }

        } else {
            ($route == '403') ? $extension = '403' : $extension = '404';

            $route = 'error'.$extension;
            $params = [];
            $controller = 'Error';
            $method = 'index'.$extension;
            $access = 'public';
            $namespace = "\Etsik\Core\\";
            $scriptJS = null;

        }

        

        $request = new Request();
        $request->setRoute($route);
        $request->setParams($params);
        $request->setController($controller);
        $request->setNamespace($namespace);
        $request->setMethod($method);
        $request->setAccess($access);
        $request->setAbsoluteUrl($action);
        $request->setScriptJS($scriptJS);

        $this->request = $request;
    }

    public function render()
    {
        $request = $this->request;
        $controller = $request->getNamespace().$request->getController().'Controller';
        $method = $request->getMethod();
        $currentController = new $controller($request);
        if(method_exists($currentController, $method)) {
            $currentController->$method();
        } else {
            throw new Exception('method not found');
        }
    }

    public function getRoute($action)
    {
        $elements = explode('/', $action);

        return $elements[0];
    }

    public function getParams($action, $vars)
    {
        $params = [];
        $elements = explode('/', $action);
        unset($elements[0]);

        foreach ($vars as $key => $var) {
            if (isset($elements[$key + 1])) {
                if ($var == "tinyContent") {
                    $data = $elements[$key + 1] ;
                } else {
                    $data = $this->validData($elements[$key + 1]);
                }
                $params[$var] = $data;
            }
        }

        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if ($key == "tinyContent") {
                    $data = $val ;
                } else {
                    $data = $this->validData($val);
                }
                $params[$key] = $data;
            }
        }

        return $params;
    }

    public function validData($datas)
    {
        if (is_array($datas)) {
            return $datas;
        }
        $datas = trim($datas);
        $datas = stripslashes($datas);
        $datas = htmlspecialchars($datas);

        return $datas;
    }
}
