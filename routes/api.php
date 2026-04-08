<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\StudentController;

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'getCurrentUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Student API routes
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'getAllStudents']);
        Route::get('/{id}', [StudentController::class, 'getStudentById']);
        Route::post('/', [StudentController::class, 'addStudent']);
        Route::put('/{id}', [StudentController::class, 'updateStudent']);
        Route::delete('/{id}', [StudentController::class, 'deleteStudent']);
    });
});

// OAuth routes
Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);


