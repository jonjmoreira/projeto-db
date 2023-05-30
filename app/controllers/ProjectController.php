<?php

declare(strict_types=1);

namespace App\Controllers;

class ProjectController extends Controller
{
    public function index()
    {
        $this->view('project/show.php');
    }
}