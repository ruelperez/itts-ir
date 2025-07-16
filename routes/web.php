<?php

use App\Http\Controllers\Dtr\PageController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth','checkEmployee'])->group(function () {
    Route::prefix('inventory')->group(function () {
        Route::get('/{page}/{emp_id}', [\App\Http\Controllers\InventoryController::class, 'page']);
        Route::get('/pdf/device-clearance/{userID}', [\App\Http\Controllers\InventoryController::class, 'clearance']);
    });
    Route::prefix('my-callback')->group(function () {
        Route::get('/{page}', [\App\Http\Controllers\MyCallbackController::class, 'page']);
    });
    Route::prefix('pdf')->group(function () {
        Route::get('/eod/{user_id}/{year}/{month}/{week}', [\App\Http\Controllers\Pdf\EodController::class, 'pdf']);
        Route::get('/daily-shift/{month}/{day}/{year}/{role}', [\App\Http\Controllers\Pdf\DailyShiftController::class, 'pdf']);
        Route::get('/leave-form/{id}', [\App\Http\Controllers\Pdf\LeaveFormController::class, 'pdf']);
    });
    Route::prefix('admin-access')->group(function () {
        Route::get('eod/{page}', [\App\Http\Controllers\AdminAccess\PageController::class, 'eod']);
        Route::get('/{folder}/{page}', [\App\Http\Controllers\AdminAccess\PageController::class, 'page']);
        Route::get('/{folder}/{page}/{id}', [\App\Http\Controllers\AdminAccess\PageController::class, 'salary']);
    });
    Route::prefix('dtr')->group(function () {
        Route::get('/all-record/{page}', [PageController::class, 'page']);
        Route::get('/all-record/{page}/{emp_id}', [PageController::class, 'employee']);
    });

    Route::post('/verify-qr-code', [PageController::class, 'verifyQrCode']);
    Route::prefix('qr-code')->group(function () {
        Route::get('/create/{employeeId}', [PageController::class, 'generateQrCode']);
        Route::get('/scanner', [PageController::class, 'scan']);
    });

    Route::get('/{page}', [\App\Http\Controllers\PageController::class, 'page']);
    Route::get('/edit-leads/{page}/{lead_id}', [\App\Http\Controllers\PageController::class, 'edit_leads']);
    Route::get('/per-shift-pdf/{moproduction-lead-mass-tortnth}/{day}/{year}/{role}', [\App\Http\Controllers\Pdf\ShiftController::class, 'pdf']);
    Route::get('/dtr-all-record-all-record/{id}', [\App\Http\Controllers\PageController::class, 'dtr_employee_record']);
    Route::post('/profile/upload', [ProfileController::class, 'uploadProfilePicture'])->name('profile.upload');
    Route::get('/campaign/{page}', [\App\Http\Controllers\Campaign\PageController::class, 'page']);
    Route::get('/campaign/mass-tort/{page}', [\App\Http\Controllers\Campaign\MasstortController::class, 'page']);
    Route::get('/deployed-item-all-record/{id}', [\App\Http\Controllers\Campaign\PageController::class, 'page']);
    Route::get('/campaign/mass-tort/mva/{page}', [\App\Http\Controllers\Campaign\MasstortController::class, 'checker']);
});

Route::middleware(['auth','checkEmployee'])
    ->prefix('link-form')->group(function () {
        Route::get('/lead-form/{page}', [\App\Http\Controllers\LinkForm\LeadForm\PageController::class, 'page']);
        Route::get('/{page}', [\App\Http\Controllers\LinkForm\LeadForm\LeaveController::class, 'page']);
    });

Route::middleware(['auth','checkEmployee'])
    ->prefix('admin-access')
    ->group(function () {
        Route::get('/{page}', [\App\Http\Controllers\AdminAccess\PageController::class, 'page']);
    });

Route::middleware(['auth'])->group(function () {
    Route::get('/employee/incomplete', [\App\Http\Controllers\PageController::class, 'employee']);
});

//Route::middleware()->group(function () {
    Route::get('/', function (){
        return redirect('/user/login');
    });
    Route::get('/user/login', function (){
        return view('user.login');
    })->name('login')->middleware('guest');
    Route::post('/login/auth', [\App\Http\Controllers\LoginController::class, 'auth']);
    Route::get('/user/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
    Route::get('/user/register', function (){
        return view('user.register');
    });
//});



// NO RESTRICT IP MIDDLEWARE
Route::get('/login/special', function (){
    return view('user.special');
});
Route::post('/login/special', [\App\Http\Controllers\LoginController::class, 'special']);

