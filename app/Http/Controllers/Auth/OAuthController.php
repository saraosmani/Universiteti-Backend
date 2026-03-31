<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'         => $googleUser->getName(),
                    'password'     => bcrypt(uniqid()),
                    'role'         => 'user',
                    'phone_number' => null,
                    'country'      => null,
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            $frontendUrl = env('FRONTEND_URL', 'http://localhost:3000');

            // Redirect to frontend with token + user encoded in query params
            return redirect(
                $frontendUrl . '/auth/callback?' . http_build_query([
                    'token' => $token,
                    'user'  => json_encode($user),
                ])
            );
        } catch (\Exception $e) {
            return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/auth/callback?error=oauth_failed');
        }
    }
}
