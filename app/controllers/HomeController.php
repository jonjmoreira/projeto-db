<?php

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/home.php');
    }

    public function showExplore()
    {
        $this->view('home/explore.php');
    }
}