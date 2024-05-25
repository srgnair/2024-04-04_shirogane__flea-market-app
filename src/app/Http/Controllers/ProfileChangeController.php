<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileChangeRequest;

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


    public function profileChange(ProfileChangeRequest $request)
    {
        $user_id = Auth::id();

        $userData = $request->except('_token');
        $userData['user_id'] = $user_id;

        // アップロードされた画像ファイルを取得
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            // 一意のファイル名を生成
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            // 画像を public/img ディレクトリに移動
            $img->move(public_path('img'), $filename);
            // 画像のパスをデータに追加
            $userData['img'] = 'img/' . $filename;
        }

        // ユーザープロフィールを更新
        $userProfile = User::findOrFail($user_id);
        $userProfile->update($userData);

        return view('profileChange', compact('userProfile'))->with('message', '登録されました！');
    }
}
