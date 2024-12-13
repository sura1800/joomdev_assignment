<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/',[DashboardController::class,'index']);
Route::post('/register',[DashboardController::class,'register'])->name('user.register');


Route::middleware('user')->prefix('user')->group(function () {
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[UserController::class,'logout'])->name('user.logout');
    Route::get('/change-password',[UserController::class,'changePassword'])->name('change_password');
    Route::post('/change-password-action',[UserController::class,'changePasswordAction'])->name('change_password_action');

    Route::get('/profile',[UserController::class,'profile'])->name('profile')->middleware('check-password-status');

});

Route::middleware('check-login')->group(function () {
    Route::get('/login', function () { return view('user.login'); })->name('login');
    Route::post('/login-action',[UserController::class,'login'])->name('user.login');
});


