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
