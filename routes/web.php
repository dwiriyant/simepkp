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

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'edit'])->name('change-password');
    Route::put('change-password', [App\Http\Controllers\ChangePasswordController::class, 'update'])->name('change-password.update');
});

Route::namespace('SuperAdmin')->prefix('super-admin')->middleware('auth', 'can:isSuperAdmin')->name('super-admin.')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard-upload', [App\Http\Controllers\DashboardController::class, 'store'])->name('dashboard.upload');

    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    Route::post('customer/upload', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.upload');
    Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');

    Route::resource('user-management', UserManagementController::class);
    Route::resource('branch', BranchController::class);
});

Route::namespace('HeadOfficeAdmin')->prefix('head-office-admin')->middleware('auth', 'can:isHeadOfficeAdmin')->name('head-office-admin.')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});

Route::namespace('BranchOfficeAdmin')->prefix('branch-office-admin')->middleware('auth', 'can:isBranchOfficeAdmin')->name('branch-office-admin.')->group(function () {

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});

Route::namespace('BranchManager')->prefix('branch-manager')->middleware('auth', 'can:isBranchManager')->name('branch-manager.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});

Route::namespace('Supervisor')->prefix('supervisor')->middleware('auth', 'can:isSupervisor')->name('supervisor.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});

Route::namespace('CreditManager')->prefix('credit-manager')->middleware('auth', 'can:isCreditManager')->name('credit-manager.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});

Route::namespace('CreditCollection')->prefix('credit-collection')->middleware('auth', 'can:isCreditCollection')->name('credit-collection.')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/detail/{customer}', [App\Http\Controllers\CustomerController::class, 'detail'])->name('customer.detail');
    Route::get('customer/create-visit/{customer}', [App\Http\Controllers\CustomerController::class, 'create_visit'])->name('customer.create-visit');
    Route::post('customer/store-visit/{customer}', [App\Http\Controllers\CustomerController::class, 'store_visit'])->name('customer.store-visit');
    Route::get('customer/edit-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'edit_visit'])->name('customer.edit-visit');
    Route::put('customer/update-visit/{visit}', [App\Http\Controllers\CustomerController::class, 'update_visit'])->name('customer.update-visit');
});
