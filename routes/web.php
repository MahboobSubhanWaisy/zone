<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/english','webDataController@english')->name('english');
Route::get('/dari','webDataController@dari')->name('dari');
Route::get('/pashto','webDataController@pashto')->name('pashto');

Route::middleware(['auth', 'localize'])->group(function () {

    Route::view('/', 'dashboard')->name('dashboard');

    // ------------------------------ Zone Routes ------------------------------ //
    Route::get('/zone-list', [ZoneController::class, 'index'])->name('zone.list');
    Route::post('/ceate-zone', [ZoneController::class, 'store'])->name('create.zone');
    Route::post('/update-zone', [ZoneController::class, 'update'])->name('update.zone');
    Route::post('/delete-zone', [ZoneController::class, 'delete'])->name('delete.zone');

    // ------------------------------ Zone Branches Routes ------------------------ //
    Route::get('/branch-list', [BranchController::class, 'index'])->name('branch.list');
    Route::post('/ceate-branch', [BranchController::class, 'store'])->name('create.branch');
    Route::post('/delete-branch', [BranchController::class, 'delete'])->name('delete.branch');
    Route::get('/get-edit-modal/{id?}', [BranchController::class, 'edit'])->name('get.edit.modal');
    Route::get('/view-modal/{id?}', [BranchController::class, 'show'])->name('get.view.modal');
    Route::post('/update-branch', [BranchController::class, 'update'])->name('update.branch');

    // ------------------------------ Time Routes ------------------------------ //
    Route::get('/edit-time', [BranchController::class, 'editTime'])->name('edit.time');
    Route::post('/update-time', [BranchController::class, 'updateTime'])->name('update.time');

    // ------------------------------ Devices Routes ------------------------------ //
    Route::get('/device-list', [DeviceController::class, 'index'])->name('device.list');
    Route::post('/create-device', [DeviceController::class, 'store'])->name('create.device');
    Route::post('/update-device', [DeviceController::class, 'update'])->name('update.device');

    // -------------------------------- Users Routes ------------------------------------- //
    Route::get('/zone-list/{id}', [RegisterController::class, 'showSites'])->name('zone-list');
    Route::post('/register-user', [RegisterController::class, 'storeUser'])->name('register-user');
    Route::get('/edit-user/{id?}', [RegisterController::class, 'edit'])->name('edit-user');
    Route::post('/update-user', [RegisterController::class, 'updateUser'])->name('update-user');

    // --------------------------- Operator Routes ------------------------------ //
    Route::get('/operator', [OperatorController::class, 'index'])->name('operator');
    Route::get('/operator-form', [OperatorController::class, 'create'])->name('operator-form');
    Route::post('/operator-report', [OperatorController::class, 'store'])->name('operator-report');
    Route::get('/operator-edit-report', [OperatorController::class, 'edit'])->name('operator-edit-report');
    Route::post('/operator-report-update', [OperatorController::class, 'update'])->name('operator-report-update');

    // --------------------------- Report Routes -------------------------------- //
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/show-report', [ReportController::class, 'show'])->name('show-report');
    Route::post('/super-admin-approve-report', [ReportController::class, 'superAdminApprove'])->name('super-admin-approve-report');

    // ------------------------- Password Rest Routes -------------------------- //
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update-password');

    // ------------------------- Password Rest Routes -------------------------- //
    Route::get('/get-notification', [NotificationController::class, 'index'])->name('get-notification');
});
