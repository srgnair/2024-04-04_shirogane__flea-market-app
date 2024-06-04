<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingChangeRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryAddress;

class ShippingChangeController extends Controller
{
    public function shippingChangeView($item_id)
    {
        session()->put('item_id', $item_id);

        return view('shippingChange', compact('item_id'));
    }

    public function shippingChange(ShippingChangeRequest $request, $item_id)
    {
        $user_id = Auth::id();

        $userData = $request->except('_token');
        $userData['user_id'] = $user_id;

        $shippingAddress = DeliveryAddress::where('user_id', $user_id)->first();

        if ($shippingAddress) {
            $shippingAddress->update($userData);
        } else {
            DeliveryAddress::create($userData);
        }

        $item_id = session()->get('item_id');

        if (!$item_id) {
            return redirect()->back()->with('error', '元のページが見つかりませんでした。');
        }

        return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('message', '登録されました！');
    }
}
