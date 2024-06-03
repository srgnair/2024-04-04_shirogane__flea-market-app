<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use Stripe\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseCompleted;

class PurchaseController extends Controller
{
    public function confirmPurchaseView($item_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404);
        }

        $itemImages = $item->itemImages;

        $transaction = $item->transaction;

        return view('confirmPurchase', compact('user', 'item', 'itemImages', 'item_id', 'transaction'))->with('stripe_public_key', config('stripe.stripe_public_key'));
    }

    public function purchase(Request $request, $item_id)
    {
        $item = Item::find($item_id);

        if (!$item) {
            return back()->with('flash_alert', 'アイテムが見つかりませんでした。');
        }

        $transaction = Transaction::where('item_id', $item_id)->first();

        if ($transaction && $transaction->payment_method === 'card') {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret.key'));

            try {
                \Stripe\Charge::create([
                    'source' => $request->stripeToken,
                    'amount' => $item->price,
                    'currency' => 'jpy',
                ]);
                $transaction->transaction_type = 'waiting_shipping';
                $transaction->save();
            } catch (Exception $e) {
                return back()->with('flash_alert', '決済に失敗しました！(' . $e->getMessage() . ')');
            }
        } elseif ($transaction && $transaction->payment_method === 'customer_balance') {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret.key'));

            try {
                $stripeCustomer = Customer::create([
                    'email' => Auth::user()->email,
                ]);
                $customer_id = $stripeCustomer->id;

                $paymentIntent = \Stripe\PaymentIntent::create([
                    'customer' => $customer_id,
                    'payment_method_types' => ['customer_balance'],
                    'amount' => $item->price,
                    'currency' => 'jpy',
                    'payment_method_options' => [
                        'customer_balance' => [
                            'funding_type' => 'bank_transfer',
                            'bank_transfer' => [
                                'type' => 'jp_bank_transfer',
                            ],
                        ],
                    ],
                ]);
                $transaction->transaction_type = 'waiting_payment';
                $transaction->save();
            } catch (Exception $e) {
                return back()->with('flash_alert', '決済に失敗しました！(' . $e->getMessage() . ')');
            }
        } else {
            return back()->with('flash_alert', '支払い方法が指定されていません。');
        }

        if ($transaction) {
            $transaction->amount = $item->price;
            $transaction->buyer_id = Auth::user()->id;
            $transaction->save();

            $item->buyer_id = Auth::user()->id;
            $item->save();

            $transaction = Transaction::where('item_id', $item_id)->first();

            $recipientEmail = $transaction->seller->email;
            $recipientName = $transaction->seller->user_name;
            $itemName = $transaction->itemName->item_name;

            $purchaseCompletedEmail = new PurchaseCompleted($recipientName, $itemName);

            Mail::to($recipientEmail)->send($purchaseCompletedEmail);

            return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('message', '購入が完了しました。');
        } else {
            return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('error', 'エラーが発生しました。');
        }
    }

    public function paymentMethodView($item_id)
    {
        session()->put('item_id', $item_id);

        return view('paymentMethod', compact('item_id'));
    }

    public function updatePaymentMethod($item_id, Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404);
        }

        $itemImages = $item->itemImages;

        $transaction = $item->transaction;

        if (!$transaction) {
            return abort(404);
        }

        $transaction->payment_method = $request->input('payment_method');
        $transaction->save();

        return redirect()->route('confirmPurchaseView', compact('user', 'item', 'itemImages', 'item_id', 'transaction'));
    }
}
