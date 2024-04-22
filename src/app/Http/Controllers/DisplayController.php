<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DisplayController extends Controller
{
    public function displayItemView()
    {
        return view('displayItem');
    }

    public function displayItem(Request $request)
    {
        //item、itemCategory、itemImageはテーブルが別

        // リクエストの内容をログに出力
        Log::info($request->all());

        $user_id = Auth::id();

        $newItem = new Item();
        $newItem->item_name = $request->input('item_name');
        $newItem->brand_name = $request->input('brand_name');
        $newItem->price = $request->input('price');
        $newItem->description = $request->input('description');
        $newItem->condition = $request->input('condition');
        // $newItem->user_id = $user_id;
        $newItem->save();

        // 新しいアイテムのIDを取得
        $item_id = $newItem->id;

        $newItemCategory = new ItemCategory();
        $newItemCategory->category = $request->input('category');
        $newItemCategory->item_id = $item_id;
        $newItemCategory->save();

        $newItemImage = new ItemImage();
        $newItemImageFile = $request->file('image');
        $filename = uniqid() . '.' . $newItemImageFile->getClientOriginalExtension();
        $newItemImageFile->move(public_path('img'), $filename);
        $newItemImage->image = 'img/' . $filename;
        $newItemImage->item_id = $item_id;
        $newItemImage->save();

        // データベースに新しいアイテムを作成
        return redirect()->route('displayItem')->with('message', '登録されました！');
    }

}
