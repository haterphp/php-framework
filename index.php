<?php

require_once './Inc/autoload.php';
$routes = require_once './routes.php';

\Inc\Router\Router::register($routes)
    ->registerAdapter(\Inc\View\Adapters\TemplateAdapter::class)
    ->watch();
