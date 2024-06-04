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
        $user = Auth::user();

        $sellersItems = Transaction::where('seller_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($sellersItems as $sellersItem) {
            $review = Review::where('reviewer_id', $sellersItem->buyer_id)
                ->where('reviewee_id', $sellersItem->seller_id)
                ->first();

            $sellersItem->review = $review;
        }

        $itemImages = ItemImage::whereIn('item_id', $sellersItems->pluck('item_id'))->get();

        return view('mypage', compact('sellersItems', 'itemImages', 'user', 'review'));
    }

    public function mypagePurchasedItemsView()
    {
        $user = Auth::user();

        $purchasedItems = Transaction::where('buyer_id', $user->id)
            ->where('transaction_type', '!=', 'listed')
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        $itemImages = ItemImage::whereIn('item_id', $purchasedItems->pluck('item_id'))->get();

        return view('MypagePurchasedItems', compact('purchasedItems', 'itemImages', 'user'));
    }
}
