<?php

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

Route::get('/', function () {
    return redirect('login');
});

Route::get('unauthorized', function(){
    abort(401);
})->name('unauthorized');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'edit'])->name('change-password');
    Route::put('change-password', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('change-password.update');
});

Route::namespace('SuperAdmin')->prefix('super-admin')->middleware('auth', 'checkSuperAdmin')->name('super-admin.')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\SuperAdmin\HomeController::class, 'index'])->name('home');
    Route::post('dashboard-upload', [App\Http\Controllers\SuperAdmin\HomeController::class, 'store'])->name('home.upload');

    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit');

    Route::resource('user-management', UserManagementController::class);
    Route::resource('branch', BranchController::class);
});

