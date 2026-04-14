<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pedagog;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'surname'      => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8',
            'phone_number' => 'required|string|max:20',
            'country'      => 'required|string|max:100',
            'role'         => 'required|string|in:student,pedagog,administrator',
            'gender'       => 'nullable|string|in:M,F',
            'birth_date'   => 'nullable|date',
            'ped_tit' => 'nullable|string|max:20',

        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'         => $request->name,
                'surname'      => $request->surname,
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'role'         => $request->role,
                'phone_number' => $request->phone_number,
                'country'      => $request->country,
            ]);

            if ($request->role === 'pedagog') {
                Pedagog::create([
                    'ped_id'    => strtoupper(substr('P' . uniqid(), 0, 10)),
                    'ped_em'    => $request->name,
                    'ped_mb'    => $request->surname,
                    'ped_gjin'  => $request->gender,
                    'ped_tit'   => $request->ped_tit,
                    'ped_dl'    => $request->birth_date,
                    'ped_tel' => preg_replace('/^\+\d{3}/', '', $request->phone_number),
                    'ped_email' => $request->email,
                    'ped_dt'    => now()->toDateString(),
                    'dep_id'    => null,
                    'user_id'   => $user->id,
                ]);
            }

            if ($request->role === 'student') {
                Student::create([
                    'stu_id'             => 'DR' . strtoupper(substr(uniqid(), 0, 10)),
                    'stu_em'             => $request->name,
                    'stu_mb'             => $request->surname,
                    'stu_atesi'          => 'I panjohur',
                    'stu_gjini'          => $request->gender,
                    'stu_dl'             => $request->birth_date,
                    'stu_nuid' => strtoupper(substr(uniqid(), 0, 10)),
                    'stu_email'          => $request->email,
                    'stu_dat_regjistrim' => now()->toDateString(),
                    'stu_status'         => 'Aktiv',
                    'user_id'            => $user->id,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Përdoruesi u regjistrua me sukses!',
                'data'    => [
                    'user'  => $user,
                    'token' => $token,
                ],
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Login user
     */
    public function login(Request $request): JsonResponse
    {
        RateLimiter::attempt(
            'login:' . $request->ip(),
            5,
            function () {},
        ) ?: throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Keni kaluar limitin e përpjekjeve. Ju lutem provoni përsëri më vonë.',
        ], 429));

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Kredencialet janë të pavlefshme.',
                'data'    => null,
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Hyrja u krye me sukses!',
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
            'message' => 'Dalja u krye me sukses!',
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
            'message' => 'Përdoruesi u mor me sukses!',
            'data'    => [
                'user' => $request->user(),
            ],
        ], 200);
    }

    public function completeProfile(Request $request): JsonResponse
    {
        RateLimiter::attempt(
            'complete-profile:' . $request->ip(),
            5,
            function () {},
        ) ?: throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Keni kaluar limitin e përpjekjeve. Ju lutem provoni përsëri më vonë.',
        ], 429));

        $request->validate([
            'temp_token'    => 'required|string',
            'phone_number'  => 'required|string|max:20',
            'country'       => 'required|string|max:100',
            'role'          => 'required|string|in:student,pedagog,administrator',
            'gender'        => 'required|string|in:M,F',
            'birth_date'    => 'required|date',
            'ped_tit'       => 'nullable|string|max:20',
        ]);

        $payload = json_decode(base64_decode($request->temp_token), true);

        if (!$payload || now()->timestamp > $payload['exp']) {
            return response()->json(['message' => 'Token i përkohshëm ka skaduar ose është i pavlefshëm'], 422);
        }

        DB::beginTransaction();

        try {
            $user = User::create([
                'name'         => $payload['name'],
                'surname'      => $payload['surname'],
                'email'        => $payload['email'],
                'password'     => Hash::make(uniqid()),
                'phone_number' => $request->phone_number,
                'country'      => $request->country,
                'role'         => $request->role,
            ]);

            if ($request->role === 'pedagog') {
                Pedagog::create([
                    'ped_id'    => strtoupper(substr('P' . uniqid(), 0, 10)),
                    'ped_em'    => $payload['name'],
                    'ped_mb'    => $payload['surname'],
                    'ped_gjin'  => $request->gender,
                    'ped_tit'   => $request->ped_tit ?? 'Msc.',
                    'ped_dl'    => $request->birth_date,
                    'ped_tel'   => preg_replace('/^\+\d{3}/', '', $request->phone_number),
                    'ped_email' => $payload['email'],
                    'ped_dt'    => now()->toDateString(),
                    'dep_id'    => null,
                    'user_id'   => $user->id,
                ]);
            }

            if ($request->role === 'student') {
                Student::create([
                    'stu_id'             => 'DR' . strtoupper(substr(uniqid(), 0, 10)),
                    'stu_em'             => $payload['name'],
                    'stu_mb'             => $payload['surname'],
                    'stu_atesi'          => 'I panjohur',
                    'stu_gjini'          => $request->gender,
                    'stu_dl'             => $request->birth_date,
                    'stu_nuid'           => strtoupper(substr(uniqid(), 0, 10)),
                    'stu_email'          => $payload['email'],
                    'stu_dat_regjistrim' => now()->toDateString(),
                    'stu_status'         => 'Aktiv',
                    'user_id'            => $user->id,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'data'    => ['user' => $user, 'token' => $token],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
