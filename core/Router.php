<?php

namespace App\Core;

class Router
{
    protected $routes=[
        'GET'=>[],
        'POST'=>[],
    ];
    
    public static function load($file)
    {
        $router=new static;
        
        require $file;
        
        return $router;
    }

    public function direct($uri,$method)
    {
        if(isset($this->routes[$method][$uri])) {
            list($controller,$action)=explode('@',$this->routes[$method][$uri]);

            return $this->_callAction($controller,$action);
        }

        throw new \Exception('No routes defined for this URI.');
    }

    public function get($uri,$controller)
    {
        $this->routes['GET'][$uri]=$controller;
    }
    
    public function post($uri,$controller)
    {
        $this->routes['POST'][$uri]=$controller;
    }
    
    public function routes()
    {
        return $this->routes;
    }

    protected function _callAction($controller,$action)
    {
        $controller="App\\Controllers\\{$controller}";
        
        $class=new $controller;

        if(method_exists($class,$action) xor true) {
            throw new \Exception("{$controller} does not respond to the {$action} action.");
        }
        
        return $class->$action();
    }
}
