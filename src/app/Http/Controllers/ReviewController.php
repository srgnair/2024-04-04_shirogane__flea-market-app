<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use App\Mail\ReviewFromBuyerCompleted;
use App\Mail\ReviewFromSellerCompleted;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function reviewView($id)
    {
        $user_id = Auth::id();

        $transaction = Transaction::where('item_id', $id)->first();

        if (!$transaction) {
            // 取引が見つからない場合の処理（例：404エラーページを表示）
            abort(404, 'Transaction not found.');
        }

        return view('review', compact('id', 'transaction'));
    }

    public function postReviewBuyer(ReviewRequest $request, $id)
    {
        $user_id = Auth::id();

        // $idを使ってtransactionテーブルからデータを取得
        $transaction = Transaction::where('item_id', $id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', '取引が見つかりませんでした');
        }

        // 同じ取引に対して既にレビューが投稿されているかを確認
        $existingReview = Review::where(
            'transaction_id',
            $transaction->id
        )
            ->where('reviewer_id', $user_id)
            ->first();

        if ($existingReview && $user_id == $transaction->buyer_id) {
            return redirect()->back()->with('error', 'この取引に対しては既にレビューを投稿済みです');
        }

        if ($user_id == $transaction->buyer_id) {
            $reviewee_id = $transaction->seller_id;
        }
        // それ以外の場合はエラーを返す
        else {
            return redirect()->back()->with('error', 'この取引のレビューを投稿する権限がありません');
        }

        // リクエストから全ての入力データを取得
        $review = $request->all();
        $review['reviewer_id'] = $user_id;
        $review['reviewee_id'] = $reviewee_id;
        $review['transaction_id'] = $transaction->id;

        // レビューをデータベースに保存
        Review::create($review);

        // transaction_typeを変更
        $transaction->transaction_type = 'waiting_review_seller';
        $transaction->save();

        $recipientEmail = $transaction->seller->email;
        $recipientName = $transaction->seller->user_name;
        $itemName = $transaction->itemName->item_name;
        $reviewFromBuyerCompletedEmail = new ReviewFromBuyerCompleted($recipientName, $itemName);

        Mail::to($recipientEmail)->send($reviewFromBuyerCompletedEmail);

        // 'id'パラメータを渡してリダイレクト
        return redirect()->route('detailView', ['id' => $id])->with('message', '登録されました！');
    }

    public function postReviewSeller(ReviewRequest $request, $id)
    {
        $user_id = Auth::id();

        // $idを使ってtransactionテーブルからデータを取得

        $transaction = Transaction::where('item_id', $id)->first();

        if (!$transaction) {
            return redirect()->back()->with('error', '取引が見つかりませんでした');
        }

        if ($user_id == $transaction->seller_id) {
            $reviewee_id = $transaction->buyer_id;
        }
        else {
            return redirect()->back()->with('error', 'この取引のレビューを投稿する権限がありません');
        }

        // リクエストから全ての入力データを取得
        $review = $request->all();
        $review['reviewer_id'] = $user_id;
        $review['reviewee_id'] = $reviewee_id;
        $review['transaction_id'] = $transaction->id;

        // レビューをデータベースに保存
        Review::create($review);

        // transaction_typeを変更
        $transaction->transaction_type = 'complete';
        $transaction->save();

        $recipientEmail = $transaction->seller->email;
        $recipientName = $transaction->seller->user_name;
        $itemName = $transaction->itemName->item_name;
        $reviewFromSellerCompletedEmail = new ReviewFromSellerCompleted($recipientName, $itemName);

        Mail::to($recipientEmail)->send($reviewFromSellerCompletedEmail);

        // 'id'パラメータを渡してリダイレクト
        return redirect()->route('detailView', ['id' => $id])->with('message', '登録されました！');
    }
}