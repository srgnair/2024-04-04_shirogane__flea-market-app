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
            $request->session()->forget('search_results');
            $request->session()->forget('seller_id');
        }

        $sellerId = $request->input('sellerId');

        if (!empty($sellerId)) {
            $results = Item::where('seller_id', $sellerId)->with('transaction')->get();
        } else {
            $results = Item::with('transaction')->orderBy('id', 'asc')->get();
        }

        return view('admin.for-admin-item-list', compact('results'));
    }


    public function sendEmailView()
    {
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
