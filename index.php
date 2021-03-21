<?php

use Etsik\Core\Router;

// config the application
require_once 'app/MyConfig.php';

MyConfig::start();

// Render routing
$router = new Router();
$router->render();


