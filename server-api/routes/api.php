<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UserDetailController;
use App\Http\Controllers\OtpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // The endpoint for Step 2
    Route::post('/user-details', [UserDetailController::class, 'store']);
    Route::get('/user-details', [UserDetailController::class, 'show']);
});
Route::post('/login', [LoginController::class, 'login']);

Route::post('/otp/generate', [OtpController::class, 'generate']);
Route::post('/otp/verify', [OtpController::class, 'verify']);
