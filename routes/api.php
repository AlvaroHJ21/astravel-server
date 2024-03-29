<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [RegisterController::class, "register"])->name('register');
Route::post('/login', [LoginController::class, "login"])->name('login');

Route::middleware("auth:sanctum")->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [LoginController::class, "logout"])->name('logout');

    Route::post('/verify-email', [VerifyEmailController::class, "verify"])->name('verify-email');

});

Route::post('/password-email', [PasswordResetController::class, "sendEmail"])->name('password.email');
Route::post('/password-reset', [PasswordResetController::class, "reset"])->name('password.reset');
