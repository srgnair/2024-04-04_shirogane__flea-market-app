<?php

namespace App\Http\Controllers;

use App\Models\ItemImage;
use App\Models\Transaction;
use App\Models\Review;
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

        foreach ($sellersItems as $sellersItem) {
            // 評価を取得
            $review = Review::where('reviewer_id', $sellersItem->buyer_id)
                ->where('reviewee_id', $sellersItem->seller_id)
                ->first();

            // $sellersItemに$reviewを関連付ける
            $sellersItem->review = $review;
        }

        // 購入した商品の画像を取得
        $itemImages = ItemImage::whereIn('item_id', $sellersItems->pluck('item_id'))->get();

        return view('mypage', compact('sellersItems', 'itemImages', 'user', 'review'));
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
