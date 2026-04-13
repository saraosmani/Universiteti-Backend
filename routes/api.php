<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PedagogController;
use App\Http\Controllers\DepartamentController; 

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('auth/complete_profile', [AuthController::class, 'completeProfile']);

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

    // Pedagogue API routes
    Route::prefix('pedagogues')->group(function () {
        Route::get('/', [PedagogController::class, 'getAllPedagogues']);
        Route::get('/{id}', [PedagogController::class, 'getPedagogueById']);
        Route::post('/', [PedagogController::class, 'addPedagogue']);
        Route::put('/{id}', [PedagogController::class, 'updatePedagogue']);
        Route::delete('/{id}', [PedagogController::class, 'deletePedagogue']);
    });

    // Profile completion

    // Departaments API routes
    Route::prefix('departaments')->group(function () {
    Route::get('/', [DepartamentController::class, 'getAllDepartaments']);
    Route::get('/{id}', [DepartamentController::class, 'getDepartamentById']);
    Route::post('/', [DepartamentController::class, 'addDepartament']);
    Route::put('/{id}', [DepartamentController::class, 'updateDepartament']);
    Route::delete('/{id}', [DepartamentController::class, 'deleteDepartament']);
    });

});

// OAuth routes
Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);