<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function confirmPurchaseView($item_id)
    {
        // 商品画像
        // 商品名
        // 支払い方法
        // 配送先住所

        //送信されたコメントを表示させる
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        // $comments = $user->comments()->with('item')->get();
        // $comments = Comment::where('item_id', $item_id)->with('user')->get();

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404); // アイテムが存在しない場合は404エラーを返す
        }

        $itemImages = $item->itemImages;

        return view('confirmPurchase', compact('user', 'item', 'itemImages', 'item_id'));
    }
}
