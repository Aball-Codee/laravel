<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function profil()
    {
        $nama = "Akbar Saputra";
        $npm = "238160004";

        return view('profil', compact('nama', 'npm'));
    }

    public function pendidikan()
    {
        $kampus = "Universitas Medan Area";
        $prodi = "Teknik Informatika";

        return view('pendidikan', compact('kampus', 'prodi'));
    }

    public function keahlian()
    {
        $skill = "Laravel, PHP, HTML, CSS, MySQL, Python";

        return view('keahlian', compact('skill'));
    }
}