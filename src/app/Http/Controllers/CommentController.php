<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
}
