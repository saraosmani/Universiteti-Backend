<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// OAuth routes
Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);


