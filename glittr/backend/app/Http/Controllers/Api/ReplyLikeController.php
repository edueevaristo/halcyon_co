<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReplyLike;
use Illuminate\Http\Request;

class ReplyLikeController extends Controller
{
    public function toggle(Request $request, $replyId)
    {
        $userId = auth()->id();

        $like = ReplyLike::where('user_id', $userId)
                        ->where('reply_id', $replyId)
                        ->first();

        if ($like) {

            $like->delete();
            $liked = false;

        } else {

            ReplyLike::create([
                'user_id' => $userId,
                'reply_id' => $replyId
            ]);

            $liked = true;
        }

        $likesCount = ReplyLike::where('reply_id', $replyId)->count();

        return response()->json(['liked' => $liked,'likes_count' => $likesCount]);
    }
}
