<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $email = $user->getEmail();
            $name = $user->getName();

            $authUser = User::updateOrCreate(
                ['email' => $email],
                ['name' => $name]
            );

            Auth::login($authUser, true);

            return redirect()->intended('');
        } catch (Exception $e) {
            return redirect('');
        }
    }
}
