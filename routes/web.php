<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/itts-ir', \App\Livewire\Ir::class)->middleware('auth');
Route::get('/itts-age-checker', \App\Livewire\AgeCompute::class)->middleware('auth');
Route::get('/itts-zip-checker', \App\Livewire\Zip::class)->middleware('auth');

Route::get('/', function () {
    return redirect('/itts-ir');
});

Route::get('/login', \App\Livewire\Login::class)->name('login')->middleware('guest');
Route::get('/register', \App\Livewire\Register::class);
