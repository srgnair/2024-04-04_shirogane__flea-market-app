<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Auth;

class MainPageController extends Controller
{
    public function mainView(Request $request)
    {
        $items = Item::all();
        $itemImages = ItemImage::whereIn('item_id', $items->pluck('item_id'))->get();

        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $condition = $request->input('condition');

        $queryItem = Item::query();

        if (!empty($keyword)) {
            $queryItem->where('item_name', 'LIKE', "%{$keyword}%");
        }

        // if (!empty($category)) {
        //     $queryItem->where('category_id', $category);
        // }
        if (!empty($category)) {
            $queryItem->whereHas('itemCategories', function ($query) use ($category) {
                $query->where('category', $category);
            });
        }

        if (!empty($condition)) {
            $queryItem->where('condition', $condition);
        }

        $items = $queryItem->get();

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
