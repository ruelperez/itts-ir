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

Route::get('/itts/1/{name}', \App\Livewire\Ir::class)->middleware('auth');
Route::get('/itts/2/{name}', \App\Livewire\AgeCompute::class)->middleware('auth');
Route::get('/itts/3/{name}', \App\Livewire\Zip::class)->middleware('auth');
Route::get('/itts/4/{name}', \App\Livewire\NewsUpdate::class)->middleware('auth')->name('news-update');;
Route::get('/itts/5/{name}', \App\Livewire\Dashboard::class)->middleware('auth');
Route::get('/itts/6/{name}', \App\Livewire\MyNotes::class)->middleware('auth');

Route::get('/', function () {
    return redirect('/itts/5/dashboard');
});

Route::get('/login', \App\Livewire\Login::class)->name('login')->middleware('guest');
Route::get('/register', \App\Livewire\Register::class);
