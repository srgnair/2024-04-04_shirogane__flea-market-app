<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationShipping;
use App\Mail\NotificationShippingComplete;
use Illuminate\Http\Request;
use App\Models\User;

class DetailPageController extends Controller
{
    public function detailView($item_id)
    {
        $item = Item::find($item_id);
        $itemCategories = ItemCategory::where('item_id', $item_id)->get();
        $itemImages = ItemImage::where('item_id', $item_id)->get();
        $likes = Like::where('item_id', $item_id)->get();
        $comments = Comment::where('item_id', $item_id)->get();

        $transaction = Transaction::where('item_id', $item_id)->first();

        if ($transaction) {
            $seller_information = User::where('id', $transaction->seller_id)->first();
        }

        return view('detail', compact('item', 'itemCategories', 'itemImages', 'likes', 'comments', 'transaction', 'seller_information'));
    }

    public function updateShippingStatusCurrently(Request $request, $id)
    {
        $transaction = Transaction::where('item_id', $id)->first();

        $recipientEmail = $transaction->buyer->email;

        $recipientName = $transaction->buyer->user_name;
        $itemName = $transaction->itemName->item_name;

        $notificationShippingEmail = new NotificationShipping($recipientName, $itemName);

        try {
            Mail::to($recipientEmail)->send($notificationShippingEmail);

            if ($transaction) {
                $transaction->transaction_type = 'waiting_arrival';
                $transaction->save();

                return redirect()->route('detailView', ['item_id' => $id])->with('message', '発送登録が完了しました。');
            } else {
                return redirect()->route('detailView', ['item_id' => $id])->with('error', 'エラーが発生しました。');
            }
        } catch (\Exception $e) {
            $message = 'メール送信に失敗しました';
            return back()->withErrors($message);
        }
    }

    public function updateShippingStatusComplete(Request $request, $id)
    {
        $transaction = Transaction::where('item_id', $id)->first();

        $recipientEmail = $transaction->seller->email;
        $recipientName = $transaction->seller->user_name;
        $itemName = $transaction->itemName->item_name;

        $notificationShippingCompleteEmail = new NotificationShippingComplete($recipientName, $itemName);

        try {
            Mail::to($recipientEmail)->send($notificationShippingCompleteEmail);

            if ($transaction) {
                $transaction->transaction_type = 'waiting_review_buyer';
                $transaction->save();

                return redirect()->route('detailView', ['item_id' => $id])->with('message', '受け取り登録が完了しました。レビューの登録をお願いします。');
            } else {
                return redirect()->route('detailView', ['item_id' => $id])->with('error', 'エラーが発生しました。');
            }
        } catch (\Exception $e) {
            $message = 'メール送信に失敗しました';
            return back()->withErrors($message);
        }
    }
}
