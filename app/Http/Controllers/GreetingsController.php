<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingsController extends Controller
{
    public function welcome()
    {
        return "Selamat datang di aplikasi Laravel!";
    }

    public function greet($name, $npm)
    {
        return "Halo, $name $npm !";
    }
}