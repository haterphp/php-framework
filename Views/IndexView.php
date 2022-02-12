<?php

namespace Views;

use Inc\View\ViewInterface;

class IndexView implements ViewInterface {

    public function handler($options): array
    {
        return [
            'title' => 'Привет, мир!'
        ];
    }

    public function render(): string
    {
        return 'index.php';
    }
}