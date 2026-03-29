<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Test API endpoint
     */
    public function test()
    {
        return response()->json([
            'success' => true,
            'message' => 'Test API endpoint is working!',
            'data' => [
                'server_time' => now()->toDateTimeString(),
                'environment' => app()->environment(),
                'app_name' => config('app.name')
            ]
        ]);
    }
}
