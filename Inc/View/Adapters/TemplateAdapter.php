<?php

namespace Inc\View\Adapters;

class TemplateAdapter implements AdapterInterface {

    private $view;

    public static function load($view){
        $t = new self;
        $t->view = new $view();
        return $t;
    }

    public function call()
    {
        $options = (object) [
            'body' => $_REQUEST,
            'url' => $_SERVER['REQUEST_URI'],
            'method' => $_SERVER['REQUEST_METHOD'],
            'host' => $_SERVER['HTTP_HOST']
        ];

        extract($this->view->handler($options));
        require_once './Templates/' . $this->view->render();
    }
}