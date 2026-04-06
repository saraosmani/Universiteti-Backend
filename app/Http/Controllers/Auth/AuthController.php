<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'surname'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6',
            'phone_number' => 'required|string|max:20',
            'country'      => 'required|string|max:100',
            'role'         => 'required|string|in:student,pedagog,administrator',
        ]);

        $user = User::create([
            'name'         => $request->name,
            'surname'      => $request->surname,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'phone_number' => $request->phone_number,
            'country'      => $request->country,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data'    => [
                'user'  => $user,
                'token' => $token,
            ],
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data'    => null,
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data'    => [
                'user'  => $user,
                'token' => $token,
            ],
        ], 200);
    }

    /**
     * Logout user (current device)
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
            'data'    => null,
        ], 200);
    }

    /**
     * Get the authenticated user
     */
    public function getCurrentUser(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data'    => [
                'user' => $request->user(),
            ],
        ], 200);
    }
}
