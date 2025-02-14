<?php

use Illuminate\Support\Facades\Route;
use NSO\Backend\Controllers\BackendController as Controller;
use NSO\Backend\Controllers\LoginController;
use NSO\Backend\Controllers\UserController;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login-store');
    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('', [Controller::class, 'index'])->name('dashboard');
        Route::get('search', [Controller::class, 'search'])->name('menu');
        Route::get('tai-khoan', [UserController::class, 'users'])->name('users');
        Route::post('tai-khoan', [UserController::class, 'search'])->name('users.search');
        Route::get('tai-khoan/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });
});
