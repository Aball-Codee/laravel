<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return 'selamat datang di aplikasi Laravel';
    }
    public function sayHello($name)
    {
        return 'Hello, ' . $name . '';
    }
}
