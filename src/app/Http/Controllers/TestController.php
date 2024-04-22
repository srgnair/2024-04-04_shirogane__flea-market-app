<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{

    // public function displayItem(Request $request)
    // {
    //     //itemレコードをcreate

    //     $user_id = Auth::id();

    //     $newItem = $request->all();
    //     $newItem['user_id'] = $user_id;

    //     $img = $request->file('image');
    //     $filename = uniqid() . '.' . $img->getClientOriginalExtension();
    //     $img->storeAs('public/img', $filename);
    //     $newItem['image'] = 'storage/img/' . $filename;

    //     Item::create($newItem);

    //     return redirect()->route('displayItem')->with('message', '登録されました！');
    // }


    public function shippingChangeView($item_id)
    {
        session()->put('item_id', $item_id);

        return view('shippingChange');
    }

    public function create()
    {
        return view('payment.create');
    }
}
