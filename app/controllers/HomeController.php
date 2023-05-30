<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->authView('home/home.php');
    }

    public function showExplore()
    {
        $this->authView('home/explore.php');
    }
}