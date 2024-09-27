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
//Route::get('/itts/2/{names}', \App\Livewire\AgeCompute::class)->middleware('auth');
//Route::get('/itts/3/{name}', \App\Livewire\Zip::class)->middleware('auth');
//Route::get('/itts/4/{name}', \App\Livewire\MassTort::class)->middleware('auth')->name('news-update');
//Route::get('/itts/5/{name}', \App\Livewire\Dashboard::class)->middleware('auth');
//Route::get('/itts/6/{name}', \App\Livewire\LinkForm::class)->middleware('auth');
//Route::get('/itts/7/{name}', \App\Livewire\Logs::class)->middleware('auth');
//Route::get('/itts/8/{name}', \App\Livewire\EmployeeDtr::class)->middleware('auth');
//Route::get('/itts/9/{name}', \App\Livewire\DtrName::class)->middleware('auth');
//Route::get('/itts/10/dtr-all-record/{name}', \App\Livewire\DtrRecord::class)->middleware('auth');
//Route::get('/itts/11/{name}', \App\Livewire\Employee::class)->middleware('auth');
//Route::get('/itts/12/{name}', \App\Livewire\PerShift::class)->middleware('auth');
//Route::get('itts/save-eod/{user_id}/{week}', [\App\Http\Controllers\EodController::class, 'pdf']);
//Route::get('itts/per-shift-pdf/{month}/{day}/{year}/{role}', [\App\Http\Controllers\ShiftController::class, 'pdf']);
//Route::get('itts/current-shift', \App\Livewire\CurrentShift::class)->middleware('auth');
//Route::get('/itts/13/{name}', \App\Livewire\Faq::class)->middleware('auth');
//Route::get('/itts/14/{name}', \App\Livewire\Notes::class)->middleware('auth');
//Route::get('/itts/15/{name}', \App\Livewire\Employee::class)->middleware('auth');
//Route::get('/itts/16/staff-directory', \App\Livewire\StaffDirectory::class)->middleware('auth');
//Route::get('/itts/17/{name}', \App\Livewire\MyDevice::class)->middleware('auth');
//Route::get('/itts/18/inventory', \App\Livewire\Inventory::class)->middleware('auth');
//Route::get('/itts/19/device-approval', \App\Livewire\DeviceApproval::class)->middleware('auth');
//Route::get('/itts/20/deployed-item', \App\Livewire\DeployedByname::class)->middleware('auth');
//Route::get('/itts/21/deployed-item-record/{userID}', \App\Livewire\DeployedItemRecord::class)->middleware('auth');
//Route::get('/itts/22/device-clearance/{userID}', [\App\Http\Controllers\ClearanceController::class, 'pdf'])->middleware('auth');
//Route::get('/itts/23/mass-tort-tracker', \App\Livewire\MasstortTracker::class)->middleware('auth');
//Route::get('/itts/24/mass-tort-form', \App\Livewire\MasstortForm::class)->middleware('auth');
//Route::get('/itts/25/mass-tort-tracker/edit/{id}', \App\Livewire\DupecheckerEdit::class)->middleware('auth');
//Route::get('/itts/26/{name}', \App\Livewire\ProductionLead::class)->middleware('auth');
//Route::get('/itts/27/dtv-tracker', \App\Livewire\DtvTracker::class)->middleware('auth');
//Route::get('/itts/28/dtv-tracker/edit/{id}', \App\Livewire\DtvEdit::class)->middleware('auth');
//Route::get('/itts/24/dtv-form', \App\Livewire\DtvForm::class)->middleware('auth');

Route::middleware(['auth','restrict.ip'])->group(function () {
    Route::get('/{page}', [\App\Http\Controllers\PageController::class, 'page']);
});

Route::middleware('restrict.ip')->group(function () {
    Route::get('/', function (){
        return redirect('/dashboard');
    });
    Route::get('/user/login', function (){
        return view('user.login');
    })->name('login')->middleware('guest');
    Route::post('/login/auth', [\App\Http\Controllers\LoginController::class, 'auth']);
    Route::get('/user/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
    Route::get('/user/register', function (){
        return view('user.register');
    });
});


