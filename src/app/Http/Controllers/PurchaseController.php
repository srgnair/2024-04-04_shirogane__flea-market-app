<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function confirmPurchaseView($item_id)
    {
        // 商品画像
        // 商品名
        // 支払い方法
        // 配送先住所
        //transaction

        //送信されたコメントを表示させる
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインしてください');
        }

        // $comments = $user->comments()->with('item')->get();
        // $comments = Comment::where('item_id', $item_id)->with('user')->get();

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404); // アイテムが存在しない場合は404エラーを返す
        }

        $itemImages = $item->itemImages;

        $transaction = $item->transaction;

        return view('confirmPurchase', compact('user', 'item', 'itemImages', 'item_id', 'transaction'));
    }

    // 商品名
    public function purchase(Request $request, $item_id)
    {
        //支払いの処理
        //transactionがlistedの場合のみボタンが押せる
        //配送先を出品者にどのように伝える？
        //transactionテーブルを購入済みに変更する（ー＞購入済みはトップページの左上にSOLDの表示）
        //

        $item = Item::find($item_id);

        // アイテムが見つからない場合はエラーを返す
        if (!$item) {
            return back()->with('flash_alert', 'アイテムが見つかりませんでした。');
        }

        // 購入が完了した商品のトランザクションを取得
        $transaction = Transaction::where('item_id', $item_id)->first();

        \Stripe\Stripe::setApiKey(config('services.stripe.secret.key'));

        try {
            \Stripe\Charge::create([
                'source' => $request->stripeToken,
                'amount' => $item->price,
                'currency' => 'jpy',
            ]);
        } catch (Exception $e) {
            return back()->with('flash_alert', '決済に失敗しました！(' . $e->getMessage() . ')');
        }

        if ($transaction) {
            // transaction_typeを「購入済み」に更新
            $transaction->transaction_type = 'purchased';
            $transaction->amount = $item->price;
            $transaction->save();

            return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('message', '購入が完了しました。');
        } else {
            return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('error', 'エラーが発生しました。');
        }
    }
}
