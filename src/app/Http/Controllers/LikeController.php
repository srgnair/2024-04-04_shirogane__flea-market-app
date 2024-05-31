<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = Auth::id();
        $item_id = $request->input('item_id');

        Like::create([
            'user_id' => $user_id,
            'item_id' => $item_id,
        ]);

        $likes_count = Like::where('item_id', $item_id)->count();

        return response()->json(['success' => true, 'liked' => true, 'likes_count' => $likes_count]);
    }

    public function deleteLike($item_id)
    {
        $user_id = Auth::id();

        $like = Like::where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->first();

        if ($like) {
            $like->delete();
            $likes_count = Like::where('item_id', $item_id)->count();
            return response()->json(['success' => true, 'liked' => false, 'likes_count' => $likes_count]);
        }

        return response()->json(['success' => false, 'liked' => true]);
    }
}
