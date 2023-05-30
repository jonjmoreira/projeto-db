<?php

declare(strict_types=1);

namespace App\Controllers;

class Controller
{
    protected function view($viewPath, $data = []){
        extract($data);
        require_once __DIR__.'/../../app/views/'.$viewPath;
    }
}