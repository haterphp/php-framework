<?php

namespace Inc\View;

interface ViewApiInterface {
    public function handler($options): object;
}