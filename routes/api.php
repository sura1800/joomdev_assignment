<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/login', [ApiController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [ApiController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/change-password', [ApiController::class, 'changePassword']);

