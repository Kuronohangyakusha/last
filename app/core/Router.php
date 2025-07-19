<?php
namespace App\Core;

 

class Router{

    private static Router|null $instance = null;

    public function getInstance(){
        if(self::$instance === null){
            self::$instance = new Router();
        }
        return self::$instance;
    }


    public static function resolve($uris){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $currentUri = trim($requestUri, '');
        
        if (isset($uris[$currentUri])) {
            $route = $uris[$currentUri];
            $controllerClass = $route['controller'];
            $method = $route['method'];
             # $middlewares = $route['middlewares'] ?? [];
            
            #runMiddleWare($middlewares);
           
            $controller = new $controllerClass();
            $controller->$method();
        } else {
           
        }
    }
}