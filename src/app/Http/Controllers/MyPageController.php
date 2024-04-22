<?php

namespace App\Http\Controllers;

use App\Models\ItemImage;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function mypageView()
    {
        //出品した商品を表示
        // transactionのseller_idがログイン中のユーザーと一致するレコードのitem_idで検索したい

        // $user = Auth::user();
        // $items = Item::all();
        // $itemImages = ItemImage::whereIn('item_id', $items->pluck('id'))->get();

        // return view('mypage', compact('items', 'itemImages', 'user'));

        $user = Auth::user();

        $sellersItems = Transaction::where('seller_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        // 購入した商品の画像を取得
        $itemImages = ItemImage::whereIn('item_id', $sellersItems->pluck('item_id'))->get();

        return view('mypage', compact('sellersItems', 'itemImages', 'user'));
    }

    public function mypagePurchasedItemsView()
    {
        // 購入した商品を表示
        // transactionのbuyer_idがログイン中のユーザーと一致するレコードのitem_idで検索したい

        $user = Auth::user();

        $purchasedItems = Transaction::where('buyer_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        // 購入した商品の画像を取得
        $itemImages = ItemImage::whereIn('item_id', $purchasedItems->pluck('item_id'))->get();

        return view('MypagePurchasedItems', compact('purchasedItems', 'itemImages', 'user'));
    }
}
