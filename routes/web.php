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

//Route::get('/itts/1/{name}', \App\Livewire\Ir::class)->middleware('auth');
Route::get('/itts/2/{names}', \App\Livewire\AgeCompute::class)->middleware('auth');
Route::get('/itts/3/{name}', \App\Livewire\Zip::class)->middleware('auth');
Route::get('/itts/4/{name}', \App\Livewire\NewsUpdate::class)->middleware('auth')->name('news-update');
Route::get('/itts/5/{name}', \App\Livewire\Dashboard::class)->middleware('auth');
Route::get('/itts/6/{name}', \App\Livewire\MyNotes::class)->middleware('auth');
Route::get('/itts/7/{name}', \App\Livewire\Logs::class)->middleware('auth');
Route::get('/itts/8/{name}', \App\Livewire\InOut::class)->middleware('auth');
Route::get('/itts/9/{name}', \App\Livewire\DtrName::class)->middleware('auth');
Route::get('/itts/10/dtr-all-record/{name}', \App\Livewire\DtrRecord::class)->middleware('auth');
Route::get('/itts/11/{name}', \App\Livewire\Employee::class)->middleware('auth');
Route::get('/itts/12/{name}', \App\Livewire\PerShift::class)->middleware('auth');
Route::get('itts/save-eod/{user_id}/{week}', [\App\Http\Controllers\EodController::class, 'pdf']);
Route::get('itts/per-shift-pdf/{month}/{day}/{year}/{role}', [\App\Http\Controllers\ShiftController::class, 'pdf']);
Route::get('itts/current-shift', \App\Livewire\CurrentShift::class)->middleware('auth');
Route::get('/itts/13/{name}', \App\Livewire\Faq::class)->middleware('auth');
Route::get('/itts/14/{name}', \App\Livewire\Notes::class)->middleware('auth');
Route::get('/itts/15/{name}', \App\Livewire\Employee::class)->middleware('auth');
Route::get('/itts/16/staff-directory', \App\Livewire\StaffDirectory::class)->middleware('auth');
Route::get('/itts/17/{name}', \App\Livewire\MyDevice::class)->middleware('auth');
Route::get('/', function (){
    return redirect('/itts/5/dashboard');
});

Route::get('/login', \App\Livewire\Login::class)->name('login')->middleware('guest');
Route::get('/register', \App\Livewire\Register::class);
