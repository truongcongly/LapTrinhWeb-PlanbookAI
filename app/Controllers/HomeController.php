<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

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

    public function sendContact()
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $subject === '' || $message === '') {
            Session::flash('error', 'Vui long dien day du thong tin lien he.');
            $this->redirect('/lien-he');
        }

        Session::flash('success', 'Gửi tin nhắn thành công. Chúng tôi sẽ phản hồi bạn trong vòng 24 giờ làm việc.');
        $this->redirect('/lien-he');
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
