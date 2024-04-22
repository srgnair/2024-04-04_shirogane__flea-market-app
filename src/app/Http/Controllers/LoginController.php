<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginView');
    }
}
