<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use App\Http\Requests\AddNewAdminRequest;
use App\Http\Requests\SendEmailRequest;

class AdminController extends Controller
{
    public function adminView()
    {
        return view('admin.admin-top');
    }

    public function addNewAdminView()
    {
        return view('admin.add-new-admin');
    }

    public function addNewAdmin(AddNewAdminRequest $request)
    {
        // dd($request->all());

        // $newAdmin['email'] = $request->email;
        // $newAdmin['user_name'] = $request->user_name;
        // $newAdmin['password'] = Hash::make($request->password);

        // User::create($newAdmin);

        // Log::info('New admin data added: ' . json_encode($newAdmin));

        $name = $request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = 'admin';

        $hashedPassword = Hash::make($password);

        User::create([
            'user_name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
        ]);

        return redirect()->route('addNewAdminView')->with('message', '登録されました！');
    }

    public function itemListView(Request $request)
    {

        if ($request->has('reset')) {
            // リセットボタンが押された場合は、セッションから検索結果と seller_id を削除
            $request->session()->forget('search_results');
            $request->session()->forget('seller_id');
        }

        $sellerId = $request->input('sellerId');

        if (!empty($sellerId)) {
            // 販売者IDが指定されている場合は、そのIDで商品を絞り込む
            $results = Item::where('seller_id', $sellerId)->with('transaction')->get();
        } else {
            // 販売者IDが指定されていない場合は、全ての商品を取得
            $results = Item::with('transaction')->orderBy('id', 'asc')->get();
        }

        // 商品リストのビューを表示
        return view('admin.for-admin-item-list', compact('results'));
    }


    public function sendEmailView()
    {
        //ユーザー情報を渡す
        $users = User::all();
        return view('admin.send-email', compact('users'));
    }

    public function sendEmail(SendEmailRequest $request)
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
}
