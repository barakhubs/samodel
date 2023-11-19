<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index ()
    {
        return view('blog.home');
    }

    public function passwordChecker ()
    {
        return view('tools.password-checker');
    }

    public function passwordGenerator ()
    {
        return view('tools.password-generator');
    }
}
