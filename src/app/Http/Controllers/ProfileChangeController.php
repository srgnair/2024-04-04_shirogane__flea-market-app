<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileChangeController extends Controller
{
    public function profileChangeView()
    {
        //変数 $userProfile にログイン中のユーザーのuser_name、post_code、address、building_nameを入れる
        //profileChangeViewで表示させる

        $user_id = Auth::id();
        $userProfile = User::find($user_id);

        return view('profileChange', compact('userProfile'));
    }

    public function profileChange()
    {
        // inputされたログイン中のユーザーのuser_name、post_code、address、building_nameを変数に入れる
        // updateメソッドでプロフィールを更新する

        return view('profileChange');
    }

}
