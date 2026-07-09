<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman Home.
     */
    public function index()
    {
        return view('home');
    }
}