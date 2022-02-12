<?php

namespace Inc\View\Adapters;

interface AdapterInterface {
    public static function load($view);
    public function call();
}