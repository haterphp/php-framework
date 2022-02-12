<?php

namespace Inc\Router;

class Router {
    private $routes;
    private $adapter;
    private $notFoundPage;
    private $prefix = "";

    private function exception($condition, $exception) {
        if($condition) throw new \Error($exception);
    }

    public static function register($routes)
    {
        $t = new self;
        $t->exception(!$routes, 'Routes can not be empty');
        $t->routes = $routes;
        return $t;
    }

    public function registerPrefix($prefix){
        $this->exception(!$prefix, "Route prefix can not be empty");
        $this->$prefix = $$prefix;
        return $this;
    }

    public function registerAdapter($adapter){
        $this->exception(!$adapter, "View Adapter can not be empty");
        $this->adapter = $adapter;
        return $this;
    }

    public function registerNotFoundPage($page)
    {
        $this->exception(!$page, "Not found page can not be empty");
        $this->notFoundPage = $page;
        return $this;
    }

    public function watch()
    {
        try {
            $url = explode('?', $_SERVER['REQUEST_URI'])[0];
            $route = $this->match($url, $_SERVER['REQUEST_METHOD']);
            $this->exception(!$this->adapter, "View adapter can not be empty");
            $this->adapter::load($route->view)->call();
        } catch(\Error $exception){
            $error = $exception->getMessage();
            require_once './Templates/error.php';
        }
    }

    private function match($url, $method){
        $idx = array_search($this->prefix . $url, array_column($this->routes, 'path'));
        $this->exception(gettype($idx) === "boolean", "Endpoint not found");
        $route = (object) $this->routes[$idx];
        $this->exception($route->method !== $method, "Method $method not allowed");
        $this->exception(!$route->view, 'Route View can not be empty');
        return $route;
    }
}