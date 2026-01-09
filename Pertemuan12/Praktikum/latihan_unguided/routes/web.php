<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

/*
| Route Root ke View Welcome dengan Data (Perbaikan)
*/
Route::get('/', function () {
    // 1. Definisikan variabel data
    $nilai = [80, 64, 30, 76, 95]; 
    
    // 2. Kirim variabel ke view 'welcome'
    return view('welcome', compact('nilai'));
});

/*
| Route dengan parameter
*/
Route::get('/user/{nama}', function ($nama) {
    return "Halo, $nama";
});

/*
| Route dengan optional parameter
*/
Route::get('/kelas/{nama?}', function ($nama = 'Mahasiswa') {
    return "Selamat datang, $nama";
});

/*
| Route ke view blade (foreach)
*/
Route::get('/mahasiswa', function () {
    $nilai = [80, 64, 30, 76, 95];
    return view('mahasiswa', compact('nilai'));
});

/*
| Route ke controller
*/
Route::get('/dashboard', [PageController::class, 'index']);