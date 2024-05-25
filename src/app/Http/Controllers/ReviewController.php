<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;

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

        // $user_idが$transaction->seller_idと一致なら、$review['reviewee_id']には$transaction->buyer_idを入れる
        // if ($user_id == $transaction->seller_id) {
        //     $reviewee_id = $transaction->buyer_id;
        // }
        // $user_idが$transaction->buyer_idと一致なら、$review['reviewee_id']には$transaction->seller_idを入れる
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

        // 同じ取引に対して既にレビューが投稿されているかを確認
        // $existingReview = Review::where(
        //     'transaction_id',
        //     $transaction->id
        // )
        //     ->where('reviewer_id', $user_id)
        //     ->first();

        // if ($existingReview && $user_id == $transaction->seller_id) {
        //     return redirect()->back()->with('error', 'この取引に対しては既にレビューを投稿済みです');
        // }

        // $user_idが$transaction->seller_idと一致なら、$review['reviewee_id']には$transaction->buyer_idを入れる
        if ($user_id == $transaction->seller_id) {
            $reviewee_id = $transaction->buyer_id;
        }
        // $user_idが$transaction->buyer_idと一致なら、$review['reviewee_id']には$transaction->seller_idを入れる
        // if ($user_id == $transaction->buyer_id) {
        //     $reviewee_id = $transaction->seller_id;
        // }
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
        $transaction->transaction_type = 'complete';
        $transaction->save();

        // 'id'パラメータを渡してリダイレクト
        return redirect()->route('detailView', ['id' => $id])->with('message', '登録されました！');
    }
}
