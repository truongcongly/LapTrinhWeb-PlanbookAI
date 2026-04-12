<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('index');
    }
    public function roles()
    {
        $this->view('roles');
    }

    public function workflow()
    {
        $this->view('workflow');
    }

    public function about()
    {
        $this->view('about');
    }
}