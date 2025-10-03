<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function course()
    {
        return view('course');
    }

    public function branche()
    {
        return view('branche');
    }

    public function result()
    {
        return view('result');
    }
}
