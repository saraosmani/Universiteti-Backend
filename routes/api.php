<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\CompleteProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PedagogController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\FakultetController;
use App\Http\Controllers\SeksionController;
use App\Http\Controllers\VleresimController;
use App\Http\Controllers\ProvimController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('auth/complete_google_registration', [AuthController::class, 'completeGoogleRegistration']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'getCurrentUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile_status', [CompleteProfileController::class, 'getProfileStatus']);

    Route::prefix('students')->group(function () {
        Route::put('/complete_profile', [CompleteProfileController::class, 'completeStudentProfile']);
        Route::get('/', [StudentController::class, 'getAllStudents']);
        Route::get('/{id}', [StudentController::class, 'getStudentById']);
        Route::post('/', [StudentController::class, 'addStudent']);
        Route::put('/{id}', [StudentController::class, 'updateStudent']);
        Route::delete('/{id}', [StudentController::class, 'deleteStudent']);
    });

    Route::prefix('pedagogues')->group(function () {
        Route::put('/complete_profile', [CompleteProfileController::class, 'completePedagogProfile']);
        Route::get('/', [PedagogController::class, 'getAllPedagogues']);
        Route::get('/{id}', [PedagogController::class, 'getPedagogueById']);
        Route::post('/', [PedagogController::class, 'addPedagogue']);
        Route::put('/{id}', [PedagogController::class, 'updatePedagogue']);
        Route::delete('/{id}', [PedagogController::class, 'deletePedagogue']);
    });

    Route::prefix('pedagog')->group(function () {
        Route::get('seksionet-aktive', [SeksionController::class, 'seksionetAktive']);
        Route::get('seksionet-historik', [SeksionController::class, 'historiku']);
    });

    Route::prefix('departaments')->group(function () {
        Route::get('/', [DepartamentController::class, 'getAllDepartaments']);
        Route::get('/{id}', [DepartamentController::class, 'getDepartamentById']);
        Route::post('/', [DepartamentController::class, 'addDepartament']);
        Route::put('/{id}', [DepartamentController::class, 'updateDepartament']);
        Route::delete('/{id}', [DepartamentController::class, 'deleteDepartament']);
    });

    Route::prefix('fakultete')->group(function () {
        Route::get('/', [FakultetController::class, 'getAllFakultete']);
        Route::get('/{id}', [FakultetController::class, 'getFakultetById']);
        Route::post('/', [FakultetController::class, 'addFakultet']);
        Route::put('/{id}', [FakultetController::class, 'updateFakultet']);
        Route::delete('/{id}', [FakultetController::class, 'deleteFakultet']);
    });

    Route::prefix('vleresim')->group(function () {
        Route::get('/lendet', [VleresimController::class, 'getLendet']);
        Route::get('/semestre', [VleresimController::class, 'getSemestre']);
        Route::get('/students', [VleresimController::class, 'getStudents']);
        Route::put('/update/{regjId}', [VleresimController::class, 'updateVleresim']);
    });

    Route::prefix('provime')->group(function () {
        Route::get('/',        [ProvimController::class, 'list']);
        Route::post('/',       [ProvimController::class, 'add']);
        Route::put('/{id}',    [ProvimController::class, 'update']);
        Route::delete('/{id}', [ProvimController::class, 'delete']);
    });
});

Route::get('auth/google', [OAuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [OAuthController::class, 'handleGoogleCallback']);