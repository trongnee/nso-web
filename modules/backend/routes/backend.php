<?php

use Illuminate\Support\Facades\Route;
use NSO\Backend\Controllers\BackendController as Controller;
use NSO\Backend\Controllers\LoginController;
use NSO\Backend\Controllers\PlayerController;
use NSO\Backend\Controllers\UserController;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login-store');
    });

    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        //Trang chủ
        Route::get('', [Controller::class, 'index'])->name('dashboard');
        Route::get('search', [Controller::class, 'search'])->name('menu');

        //Danh sách tài khoản
        Route::get('tai-khoan', [UserController::class, 'users'])->name('users');
        Route::post('tai-khoan', [UserController::class, 'search'])->name('users.search');
        Route::get('tai-khoan/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('update-balance', [UserController::class, 'updateBalance'])->name('users.update-balance');
        Route::post('update-user', [UserController::class, 'updateUser'])->name('users.update');

        //Danh sách nhân vật
        Route::get('nhan-vat', [PlayerController::class, 'players'])->name('players');
        Route::post('nhan-vat', [PlayerController::class, 'search'])->name('players.search');
        Route::get('nhan-vat/{id}', [PlayerController::class, 'edit'])->name('players.edit');

        //Danh sách vật phẩm
        Route::get('vat-pham', [Controller::class, 'items'])->name('items');
    });
});
