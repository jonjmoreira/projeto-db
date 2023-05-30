<?php

declare(strict_types=1);

namespace Routes;

class Route
{
    private static $routes = [];

    public static function add($url, $controllerAction, $method = 'GET')
    {
        self::$routes[$method][$url] = $controllerAction;
    }

    public static function dispatch($url, $method)
    {
        if (array_key_exists($method, self::$routes) && (array_key_exists($url, self::$routes[$method]))) {
            $controllerAction = self::$routes[$method][$url];
            list($controller, $action) = explode('@', $controllerAction);

            // Instantiate the controller and call the action
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            // Handle 404 Not Found error
            echo '404 Not Found';
        }
    }
}
