<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function mainView()
    {
        // $user = Auth::user();
        // $reservations = $user->reserves()->with('shop')->orderBy('reserved_date', 'asc')->get();
        // $likes = $user->likes()->with('shop')->get();

        $items = Item::all();
        $itemImages = ItemImage::whereIn('item_id', $items->pluck('item_id'))->get();

        return view('main', compact('items', 'itemImages'));
    }

    public function mainMyDisplayItemsView()
    {
        // ログイン中のユーザーがいいねしたアイテムを取得する
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        $likeItems = $user->likes()->with('item')->get();

        $itemImages = ItemImage::whereIn('item_id', $likeItems->pluck('item_id'))->get();

        return view('mainMyDisplayItems', compact('likeItems', 'itemImages'));
    }
}
