<?php

declare(strict_types=1);

namespace App\Controllers;

class Controller
{
    protected function view($viewPath){
        include __DIR__.'/../../app/views/'.$viewPath;
    }

    protected function authenticate()
    {
        if (isset($_SESSION['islogged']) && $_SESSION['islogged']) {
            return true;
        } else {
            return false;
        }
    }

    protected function authView($path)
    {
        if($this->authenticate()) {
            $this->view($path);
        } else {
            header('location: /welcome');
        }
    }
}