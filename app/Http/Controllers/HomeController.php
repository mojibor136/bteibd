<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function course()
    {
        $courses = Course::all();

        return view('course' , compact('courses'));
    }

    public function branch()
    {
        $user = User::all();

        return view('branche' , compact('user'));
    }

    public function result()
    {
        return view('result');
    }
}
