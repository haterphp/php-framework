<?php

namespace Inc\View;

interface ViewInterface {
    public function handler($options): array;
    public function render(): string;
}