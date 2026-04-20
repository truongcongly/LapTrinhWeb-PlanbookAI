<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('index');
    }

    public function teacher()
    {
        $this->view('teacher_landing');
    }

    public function school()
    {
        $this->view('school_landing');
    }

    public function pricing()
    {
        $this->view('pricing');
    }

    public function mobileApp()
    {
        $this->view('mobile_app');
    }

    public function contact()
    {
        $this->view('contact');
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
