<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\DeliveryAddress;
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

        return view('shippingChange', compact('item_id'));
    }

    public function shippingChange(Request $request, $item_id)
    {
        $user_id = Auth::id();

        $userData = $request->except('_token');
        $userData['user_id'] = $user_id;

        $shippingAddress = DeliveryAddress::findOrFail($user_id);
        $shippingAddress->update($userData);

        // 元の商品購入確認ページに戻るためにセッションに商品IDを保存する
        $item_id = session()->get('item_id');

        // 商品IDがセッションにない場合は適切な処理を行う（例: エラーを表示する、リダイレクトするなど）
        if (!$item_id) {
            return redirect()->back()->with('error', '元のページが見つかりませんでした。');
        }

        // 商品購入確認ページにリダイレクトする際に商品IDを渡す
        return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('message', '登録されました！');
    }

    public function create()
    {
        return view('payment.create');
    }
}
