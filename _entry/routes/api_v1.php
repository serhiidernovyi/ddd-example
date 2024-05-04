<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('change', [AuthController::class, 'changePassword'])->name('change');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//    Route::post('register', [RegisterController::class, 'register'])->name('register');
});
