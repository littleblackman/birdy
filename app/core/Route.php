<?php

namespace Etsik\Core;

class Route
{
    public static function createRoutesArray()
    {
        $routes = parse_ini_file(CONFIG.'routes.ini', true);
        $GLOBALS['routes'] = $routes;
        foreach ($routes as $name => $route) {
            $route['name'] = $name;
            $new_routes[$route['url']] = $route;
        }
        return $new_routes;
    }
}
