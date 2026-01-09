<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


/*
| Route tanpa parameter
*/
Route::get('/', function () {
    return 'Halaman Home';
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
