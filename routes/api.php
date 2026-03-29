<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

// Test endpoint
Route::get('/test', [TestController::class, 'test']);

// Health check endpoint
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is running',
        'timestamp' => now()
    ]);
});

// Example POST endpoint
Route::post('/test/echo', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'Echo endpoint',
        'data' => $request->all()
    ]);
});
