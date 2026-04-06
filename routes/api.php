<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'getCurrentUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('complete-profile', [AuthController::class, 'completeProfile']);
});

// OAuth routes
Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);


