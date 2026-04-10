<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $fullName  = $googleUser->getName();
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName  = isset($nameParts[1]) ? $nameParts[1] : '';
            $email     = $googleUser->getEmail();

            $existingUser = User::where('email', $email)->first();

            if ($existingUser) {
                $token = $existingUser->createToken('auth_token')->plainTextToken;
                $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');
                return redirect(
                    $frontendUrl . '/auth/callback?' . http_build_query([
                        'token'  => $token,
                        'user'   => json_encode($existingUser),
                        'is_new' => '0',
                    ])
                );
            }

            $tempPayload = base64_encode(json_encode([
                'email'   => $email,
                'name'    => $firstName,
                'surname' => $lastName,
                'exp'     => now()->addMinutes(15)->timestamp,
            ]));

            $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');
            return redirect(
                $frontendUrl . '/auth/callback?' . http_build_query([
                    'temp_token' => $tempPayload,
                    'is_new'     => '1',
                ])
            );
        } catch (\Exception $e) {
            return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/auth/callback?error=oauth_failed');
        }
    }
}
