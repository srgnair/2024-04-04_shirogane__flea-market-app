<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function commentView($item_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('loginView')->with('error', 'ログインするとコメントが見れます');
        }

        $comments = Comment::where('item_id', $item_id)->with('user')->get();

        $item = Item::find($item_id);
        if (!$item) {
            return abort(404);
        }

        $itemImages = $item->itemImages;
        $likes = Like::where('item_id', $item_id)->get();

        return view('comment', compact('comments', 'user', 'item', 'itemImages', 'likes', 'item_id'));
    }

    public function comment(CommentRequest $request, $item_id)
    {
        $user_id = Auth::id();

        $comment = $request->all();

        $comment['user_id'] = $user_id;
        $comment['item_id'] = $item_id;

        Comment::create($comment);

        return redirect()->route('commentView', ['item_id' => $item_id]);
    }

    public function commentDelete($comment_id, $item_id)
    {
        Comment::findOrFail($comment_id)->delete();

        return redirect()->route('commentView', ['item_id' => $item_id]);
    }
}
