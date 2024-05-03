<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        //$user->sendEmailVerificationNotification();

        return redirect()->route('loginView')->with('message', '登録されました！');
    }
}
