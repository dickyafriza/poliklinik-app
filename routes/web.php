<?php

use App\Http\Controllers\PoliController;
use App\Models\Poli;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [App\Http\Controllers\AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showregister'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');




Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () 
{  Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::resource('polis', PoliController::class);
Route::resource('dokter', DokterController::class);

});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () 
{  Route::get('/dashboard', function(){
    return view('dokter.dashboard');
})->name('dokter.dashboard');
});

// Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () 
// {  Route::get('/dashboard', function(){
//     return view('pasien.dashboard');
// })->name('pasien.dashboard');
// });