<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\DisplayItemRequest;

class DisplayController extends Controller
{
    public function displayItemView()
    {
        return view('displayItem');
    }

    public function displayItem(DisplayItemRequest $request)
    {
        Log::info($request->all());

        $user_id = Auth::id();

        $newItem = new Item();
        $newItem->item_name = $request->input('item_name');
        $newItem->brand_name = $request->input('brand_name');
        $newItem->price = $request->input('price');
        $newItem->description = $request->input('description');
        $newItem->condition = $request->input('condition');
        $newItem->seller_id = $user_id;
        $newItem->save();

        $item_id = $newItem->id;

        $newItemCategory = new ItemCategory();
        $newItemCategory->category =
            $request->input('category');
        $newItemCategory->item_id = $item_id;
        $newItemCategory->save();

        $newItem->category_id = $newItemCategory->id;
        $newItem->save();

        $newItemImage = new ItemImage();
        $newItemImageFile = $request->file('image');
        $filename = uniqid() . '.' . $newItemImageFile->getClientOriginalExtension();
        $newItemImageFile->move(public_path('img'), $filename);
        $newItemImage->image = 'img/' . $filename;
        $newItemImage->item_id = $item_id;
        $newItemImage->save();

        $newItemTransaction = new Transaction();
        $newItemTransaction->seller_id = $user_id;
        $newItemTransaction->item_id = $item_id;
        $newItemTransaction->transaction_type = 'listed';
        $newItemTransaction->save();

        return redirect()->route('displayItem')->with('message', '登録されました！');
    }
}
