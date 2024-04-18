<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\ItemCategory;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TestController extends Controller
{
    public function commentView($item_id)
    {
        //送信されたコメントを表示させる
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインするとコメントが見れます');
        }

        // $comments = $user->comments()->with('item')->get();
        $comments = Comment::where('item_id', $item_id)->with('user')->get();

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404); // アイテムが存在しない場合は404エラーを返す
        }

        $itemImages = $item->itemImages;
        $likes = Like::where('item_id', $item_id)->get();

        return view('comment', compact('comments', 'user', 'item', 'itemImages', 'likes', 'item_id'));
    }

    public function comment(Request $request, $item_id)
    {
        //コメントを送信する
        //コメントテーブルをcreateする
        //user_idとitem_idとtext

        $user_id = Auth::id();

        $comment = $request->all();

        $comment['user_id'] = $user_id;
        $comment['item_id'] = $item_id;

        Comment::create($comment);

        return redirect()->route('commentView', ['item_id' => $item_id]);
    }

    public function commentDelete($comment_id, $item_id)
    {
        //コメントをidで検索してレコードを削除する
        Comment::findOrFail($comment_id)->delete();

        return redirect()->route('commentView', ['item_id' => $item_id]);
    }

    public function confirmPurchaseView($item_id)
    {
        // 商品画像
        // 商品名
        // 支払い方法
        // 配送先住所

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

        return view('confirmPurchase', compact('user', 'item', 'itemImages', 'item_id'));
    }

    public function detailView($item_id)
    {
        //コメントの数
        // 商品IDに基づいて商品情報を取得する

        $item = Item::find($item_id);
        $itemCategories = ItemCategory::where('item_id', $item_id)->get();
        $itemImages = ItemImage::where('item_id', $item_id)->get();
        $likes = Like::where('item_id', $item_id)->get();
        $comments = Comment::where('item_id', $item_id)->get();

        return view('detail', compact('item', 'itemCategories', 'itemImages', 'likes', 'comments'));
    }

    public function displayItemView()
    {
        return view('displayItem');
    }

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

    public function displayItem(Request $request)
    {
        //item、itemCategory、itemImageはテーブルが別

        // リクエストの内容をログに出力
        Log::info($request->all());

        $user_id = Auth::id();

        $newItem = new Item();
        $newItem->item_name = $request->input('item_name');
        $newItem->brand_name = $request->input('brand_name');
        $newItem->price = $request->input('price');
        $newItem->description = $request->input('description');
        $newItem->condition = $request->input('condition');
        // $newItem->user_id = $user_id;
        $newItem->save();

        // 新しいアイテムのIDを取得
        $item_id = $newItem->id;

        $newItemCategory = new ItemCategory();
        $newItemCategory->category = $request->input('category');
        $newItemCategory->item_id = $item_id;
        $newItemCategory->save();

        $newItemImage = new ItemImage();
        $newItemImageFile = $request->file('image');
        $filename = uniqid() . '.' . $newItemImageFile->getClientOriginalExtension();
        $newItemImageFile->move(public_path('img'), $filename);
        $newItemImage->image = 'img/' . $filename;
        $newItemImage->item_id = $item_id;
        $newItemImage->save();

        // データベースに新しいアイテムを作成
        return redirect()->route('displayItem')->with('message', '登録されました！');
    }


    public function loginView()
    {
        return view('auth.login');
    }

    public function mainView()
    {
        // $user = Auth::user();
        // $reservations = $user->reserves()->with('shop')->orderBy('reserved_date', 'asc')->get();
        // $likes = $user->likes()->with('shop')->get();

        $items = Item::all();
        $itemImages = ItemImage::whereIn('item_id', $items->pluck('item_id'))->get();

        return view('main', compact('items', 'itemImages'));
    }

    public function mainMyDisplayItemsView()
    {
        // ログイン中のユーザーがいいねしたアイテムを取得する
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $likeItems = $user->likes()->with('item')->get();

        $itemImages = ItemImage::whereIn('item_id', $likeItems->pluck('item_id'))->get();

        return view('mainMyDisplayItems', compact('likeItems', 'itemImages'));
    }

    public function mypageView()
    {
        //出品した商品を表示
        // transactionのseller_idがログイン中のユーザーと一致するレコードのitem_idで検索したい

        // $user = Auth::user();
        // $items = Item::all();
        // $itemImages = ItemImage::whereIn('item_id', $items->pluck('id'))->get();

        // return view('mypage', compact('items', 'itemImages', 'user'));

        $user = Auth::user();

        $sellersItems = Transaction::where('seller_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        // 購入した商品の画像を取得
        $itemImages = ItemImage::whereIn('item_id', $sellersItems->pluck('item_id'))->get();

        return view('mypage', compact('sellersItems', 'itemImages', 'user'));
    }

    public function mypagePurchasedItemsView()
    {
        // 購入した商品を表示
        // transactionのbuyer_idがログイン中のユーザーと一致するレコードのitem_idで検索したい

        $user = Auth::user();

        $purchasedItems = Transaction::where('buyer_id', $user->id)
            ->with('item')
            ->orderBy('created_at', 'asc')
            ->get();

        // 購入した商品の画像を取得
        $itemImages = ItemImage::whereIn('item_id', $purchasedItems->pluck('item_id'))->get();

        return view('MypagePurchasedItems', compact('purchasedItems', 'itemImages', 'user'));
    }

    public function profileChangeView()
    {
        //変数 $userProfile にログイン中のユーザーのuser_name、post_code、address、building_nameを入れる
        //profileChangeViewで表示させる

        $user_id = Auth::id();
        $userProfile = User::find($user_id);

        return view('profileChange', compact('userProfile'));
    }

    public function profileChange()
    {
        // inputされたログイン中のユーザーのuser_name、post_code、address、building_nameを変数に入れる
        // updateメソッドでプロフィールを更新する

        return view('profileChange');
    }

    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        //$user->sendEmailVerificationNotification();

        return redirect()->route('loginView');
    }

    public function shippingChangeView()
    {
        return view('shippingChange');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginView');
    }

    public function like(Request $request)
    {
        $user_id = Auth::id();
        $item_id = $request->input('item_id');

        $like = [
            'user_id' => $user_id,
            'item_id' => $item_id,
        ];

        Like::create($like);

        return back();
    }

    public function deleteLike($item_id)
    {
        $userId = Auth::id();

        Like::where('user_id', $userId)
            ->where('item_id', $item_id)
            ->delete();

        return back();
    }
}
