<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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

    public function profileChange(Request $request)
    {
        // ログイン中のユーザーのIDを取得
        $user_id = Auth::id();

        // ユーザーを取得
        $userProfile = User::find($user_id);

        // フォームから送信されたデータを取得
        $userData = $request->except('_token');

        // パスワードが空の場合は除外する
        if (empty($userData['password'])) {
            unset($userData['password']);
        } else {
            // パスワードをハッシュ化する
            $userData['password'] = Hash::make($userData['password']);
        }

        // ユーザーデータを更新
        $userProfile->update($userData);

        // 更新後のユーザーデータを再取得（更新された情報を表示するため）
        $userProfile = User::find($user_id);

        // プロフィール変更画面に戻る
        return view('profileChange', compact('userProfile'))->with('message', '登録されました！');
    }
}
