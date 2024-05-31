<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LineLoginController extends Controller
{
    public function redirectToLine()
    {
        return Socialite::driver('line')->redirect();
    }


    public function handleLineCallback()
    {
        try {
            $lineUser = Socialite::driver('line')->user();
            $lineId = $lineUser->getId();
            $email = $lineUser->getEmail();
            $name = $lineUser->getName();

            // ユーザーの作成または取得
            $user = User::updateOrCreate(
                ['line_id' => $lineId],
                ['name' => $name, 'email' => $email]
            );

            Auth::login($user);

            return redirect()->intended('');
        } catch (Exception $e) {
            Log::error($e);
            return redirect('');
        }
    }
}
