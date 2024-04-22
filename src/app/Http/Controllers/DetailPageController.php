<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\Like;

class DetailPageController extends Controller
{
    public function detailView($item_id)
    {
        //コメントの数
        // 商品IDに基づいて商品情報を取得する

        $item = Item::find($item_id);
        $itemCategories = ItemCategory::where('item_id', $item_id)->get();
        $itemImages = ItemImage::where('item_id', $item_id)->get();
        $likes = Like::where('item_id', $item_id)->get();
        $comments = Comment::where('item_id', $item_id)->get();

        return view('detail', compact('item', 'itemCategories', 'itemImages', 'likes', 'comments'));
    }
}
