<?php

class MyConfig
{
    public static function start()
    {
        // gérer les erreurs
        ini_set('display_errors', 'on');
        error_reporting(E_ALL);

        // lancer la session
        session_start();

        // define const params
        $params = parse_ini_file('config/params.ini', true);

        // création des constants
        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        $folder = $params['app']['folder'];

        define('ROOT', $root.''.$folder.'/');
        define('HOST', 'http://'.$host.'/'.$folder.'/');

        define('ASSETS', HOST.'assets/');
        define('CSS', ASSETS.'css/');
        define('JS', ASSETS.'js/');
        define('IMG', ASSETS.'img/');

        define('CORE', ROOT.'app/core/');
        define('CONTROLLER', ROOT.'src/controller/');
        define('VIEW', ROOT.'src/view/');

        define('CONFIG', ROOT.'app/config/');
        define('HELPER', CORE.'helper/');

        define('SRC',  ROOT.'src/');
        define('MANAGER', ROOT.'src/model/manager/');
        define('ENTITY', ROOT.'src/model/entity/');
        define('SERVICE', ROOT.'src/service/');
        define('MODEL', ROOT.'src/model/');

        define('DB_HOST', $params['bdd']['DB_HOST']);
        define('DB_NAME', $params['bdd']['DB_NAME']);
        define('DB_LOGIN', $params['bdd']['DB_LOGIN']);
        define('DB_PWD', $params['bdd']['DB_PWD']);

        define('DEFAULT_PAGE_TITLE', $params['default']['PAGE_TITLE']);
        define('DEFAULT_PAGE_DESCRIPTION', $params['default']['PAGE_DESCRIPTION']);

        // env and namespace
        define('ENV', $params['app']['env']);
        define('NSPACE', $params['app']['namespace']);
        define('APP_NAME', $params['app']['name'] );


        require_once CONFIG.'functions.php';

        // gérer autoload
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($namespace)
    {
        $elements = explode('\\', $namespace);
        $class = $elements[count($elements) - 1];

        if($elements[0] == "Etsik") {
            if (file_exists(CORE.$class.'.php')) {
                include_once CORE.$class.'.php';
            } else if (file_exists(CORE.'/model/entity/'.$class.'.php')) {
                include_once CORE.'/model/entity/'.$class.'.php';
            } else if (file_exists(CORE.'/model/manager/'.$class.'.php')) {
                include_once CORE.'/model/manager/'.$class.'.php';
            } else if (file_exists(CORE.'/model/validator/'.$class.'.php')) {
                include_once CORE.'/model/validator/'.$class.'.php';
            } else if (file_exists(CORE.'/service/'.$class.'.php')) {
                include_once CORE.'/service/'.$class.'.php';
            }
        }
        
        if (file_exists(CONTROLLER.$class.'.php')) {
            include_once CONTROLLER.$class.'.php';
        } elseif (file_exists(MANAGER.$class.'.php')) {
            include_once MANAGER.$class.'.php';
        } elseif (file_exists(ENTITY.$class.'.php')) {
            include_once ENTITY.$class.'.php';
        } elseif (file_exists(SERVICE.$class.'.php')) {
            include_once SERVICE.$class.'.php';
        } elseif (file_exists(CORE.'controller/'.$class.'.php')) {
            include_once CORE.'controller/'.$class.'.php';
        } elseif (file_exists(MODEL.'validator/'.$class.'.php')) {
            include_once MODEL.'validator/'.$class.'.php';
        }
    }
}
