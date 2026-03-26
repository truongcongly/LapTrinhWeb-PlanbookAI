<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Auth;

class LogoutController extends Controller
{
    public function index()
    {
        Auth::logout();
        $this->redirect('/login');
    }
}