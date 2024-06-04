<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileChangeRequest;

class ProfileChangeController extends Controller
{
    public function profileChangeView()
    {
        $user_id = Auth::id();
        $userProfile = User::find($user_id);

        return view('profileChange', compact('userProfile'));
    }

    public function profileChange(ProfileChangeRequest $request)
    {
        $user_id = Auth::id();

        $userData = $request->except('_token');
        $userData['user_id'] = $user_id;

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('img'), $filename);
            $userData['img'] = 'img/' . $filename;
        }

        $userProfile = User::findOrFail($user_id);
        $userProfile->update($userData);

        return view('profileChange', compact('userProfile'))->with('message', '登録されました！');
    }
}
