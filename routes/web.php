<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GreetingsController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;

// ===============================
// Halaman Utama
// ===============================

Route::get('/', [PortfolioController::class, 'home']);


// ===============================
// Greetings
// ===============================

Route::get('/welcome', [GreetingsController::class, 'welcome']);

Route::get('/greet/{name}/{npm}', [
    GreetingsController::class,
    'greet'
]);


// ===============================
// Portfolio
// ===============================

Route::get('/profil', [
    PortfolioController::class,
    'profil'
]);

Route::get('/pendidikan', [
    PortfolioController::class,
    'pendidikan'
]);

Route::get('/keahlian', [
    PortfolioController::class,
    'keahlian'
]);


// ===============================
// Nilai Mahasiswa
// ===============================

Route::get('/nilai/{mahasiswaId}', [
    NilaiController::class,
    'showNilaiMahasiswa'
])->name('tampilnilai');


// ===============================
// Authentication Guest
// ===============================

Route::middleware('guest')->group(function () {

    // ===========================
    // Register
    // ===========================

    Route::get('/register', [
        RegisterController::class,
        'showRegistrationForm'
    ])->name('register');

    Route::post('/register', [
        RegisterController::class,
        'register'
    ])->name('register.process');


    // ===========================
    // Login
    // ===========================

    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'cekLogin'
    ])->name('cek-login');


    // ===========================
    // Forgot Password
    // ===========================

    Route::get('/forgot-password', [
        ForgotPasswordController::class,
        'showLinkRequestForm'
    ])->name('password.request');

    // URL sesuai modul
    Route::get('/password/reset', [
        ForgotPasswordController::class,
        'showLinkRequestForm'
    ]);

    Route::post('/forgot-password', [
        ForgotPasswordController::class,
        'sendResetLinkEmail'
    ])->name('password.email');


    // ===========================
    // Reset Password
    // ===========================

    Route::get('/reset-password/{token}', [
        ResetPasswordController::class,
        'showResetForm'
    ])->name('password.reset');

    // URL sesuai modul
    Route::get('/password/reset/{token}', [
        ResetPasswordController::class,
        'showResetForm'
    ]);

    Route::post('/reset-password', [
        ResetPasswordController::class,
        'reset'
    ])->name('password.update');

});


// ===============================
// Authentication User (Sudah Login)
// ===============================

Route::middleware('auth')->group(function () {

    Route::get('/home', [
        HomeController::class,
        'index'
    ])->name('home');

    // Logout (Metode POST)
    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');


    // ================================================
    // BAGIAN ROUTE UPLOAD DIPINDAHKAN KE SINI
    // (Masih dalam auth, tapi KELUAR dari middleware age)
    // ================================================
    Route::get('/upload', [FileUploadController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload', [FileUploadController::class, 'storeFile'])->name('upload.store');
    Route::get('/files', [FileUploadController::class, 'listFiles'])->name('files.list');
    Route::delete('/files/delete/{filename}', [FileUploadController::class, 'deleteFile'])->name('files.delete');

});


// ===============================
// Dashboard (Middleware Age)
// ===============================

Route::middleware(['auth', 'age'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});


// ===============================
// MODUL 9: SCAN QR / BARCODE
// ===============================

// --- PRAKTIKUM 1: Scan Kamera (Menggunakan fungsi scanCode) ---
Route::get('/scankode', [ScanController::class, 'scanCode'])->name('scankode');
Route::post('/scan', [ScanController::class, 'processScan']);

// --- PRAKTIKUM 2: Input Manual + Tabel Keranjang (Menggunakan fungsi scanProduk) ---
Route::get('/scan', [ScanController::class, 'scanProduk'])->name('scan');

// PERBAIKAN DI SINI: Arahkan ke processScanProduk (bukan processScan)
Route::post('/scan-produk', [ScanController::class, 'processScanProduk']);

Route::resource('users', UserController::class);