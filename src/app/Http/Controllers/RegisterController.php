<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    public function registerView()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        User::create([
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        return redirect()->route('loginView')->with('message', '登録されました！');
    }
}
