<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\DeliveryAddress;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use App\Models\Review;

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

    // public function shippingChange(Request $request, $item_id)
    // {
    //     $user_id = Auth::id();

    //     $userData = $request->except('_token');
    //     $userData['user_id'] = $user_id;

    //     $shippingAddress = DeliveryAddress::findOrFail($user_id);
    //     $shippingAddress->update($userData);

    //     // 元の商品購入確認ページに戻るためにセッションに商品IDを保存する
    //     $item_id = session()->get('item_id');

    //     // 商品IDがセッションにない場合は適切な処理を行う（例: エラーを表示する、リダイレクトするなど）
    //     if (!$item_id) {
    //         return redirect()->back()->with('error', '元のページが見つかりませんでした。');
    //     }

    //     // 商品購入確認ページにリダイレクトする際に商品IDを渡す
    //     return redirect()->route('confirmPurchaseView', ['item_id' => $item_id])->with('message', '登録されました！');
    // }

    public function shippingChange(Request $request, $item_id)
    {
        $user_id = Auth::id();

        $userData = $request->except('_token');
        $userData['user_id'] = $user_id;

        // 既存の住所があるかチェック
        $shippingAddress = DeliveryAddress::where('user_id', $user_id)->first();

        if ($shippingAddress) {
            // 既存の住所がある場合はアップデート
            $shippingAddress->update($userData);
        } else {
            // 既存の住所がない場合は新規作成
            DeliveryAddress::create($userData);
        }

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

    public function adminView()
    {
        return view('admin.admin-top');
    }

    public function addNewAdminView()
    {
        return view('admin.add-new-admin');
    }

    public function addNewAdmin(Request $request)
    {
        // dd($request->all());

        // $newAdmin['email'] = $request->email;
        // $newAdmin['user_name'] = $request->user_name;
        // $newAdmin['password'] = Hash::make($request->password);

        // User::create($newAdmin);

        // Log::info('New admin data added: ' . json_encode($newAdmin));

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = 'admin';

        $hashedPassword = Hash::make($password);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
        ]);

        return redirect()->route('addNewAdminView')->with('message', '登録されました！');
    }

    public function itemListView()
    {
        //item.phpとtransaction.phpの値をわたす
        $items = Item::with('transaction')->orderBy('id', 'asc')->get();

        return view('admin.for-admin-item-list', compact('items'));
    }

    public function sendEmailView()
    {
        //ユーザー情報を渡す
        $users = User::all();
        return view('admin.send-email', compact('users'));
    }

    public function sendEmail(Request $request)
    {
        $subject = $request->input('subject');
        $body = $request->input('body');
        $recipient = $request->input('recipient');
        $notificationEmail = new NotificationEmail($subject, $body);

        try {
            // メール送信処理
            Mail::to($recipient)->send($notificationEmail);

            $message = 'メールを送信しました';
            return redirect()->route('sendEmailView')->with(compact('message'));
        } catch (\Exception $e) {
            $message = 'メール送信に失敗しました';
            return back()->withErrors($message);
        }
    }

    public function confirmAmountView()
    {
        $amounts = Item::with('transaction')->orderBy('id', 'asc')->get();

        return view('admin.confirm-amount', compact('amounts'));
    }

    // public function sendShippingNotification($name, $productName)
    // {
    //     $name =  ;

    //     return view('shipping.notification', compact('name', 'productName'));
    // }

    public function reviewView($id)
    {
        return view('review', ['id' => $id]);
    }

    public function postReview(Request $request, $id)
    {
        $user_id = Auth::id();

        // $idを使ってtransactionテーブルからデータを取得
        $transaction = Transaction::find($id);

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

        if ($existingReview) {
            return redirect()->back()->with('error', 'この取引に対しては既にレビューを投稿済みです');
        }

        // $user_idが$transaction->seller_idと一致なら、$review['reviewee_id']には$transaction->buyer_idを入れる
        if ($user_id == $transaction->seller_id) {
            $reviewee_id = $transaction->buyer_id;
        }
        // $user_idが$transaction->buyer_idと一致なら、$review['reviewee_id']には$transaction->seller_idを入れる
        elseif ($user_id == $transaction->buyer_id) {
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
        $transaction->transaction_type = 'commentOK';
        $transaction->save();

        // 'id'パラメータを渡してリダイレクト
        return redirect()->route('reviewView', ['id' => $id])->with('message', '登録されました！');
    }
}
