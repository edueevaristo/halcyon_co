<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReviewLike;
use Illuminate\Http\Request;

class ReviewLikeController extends Controller
{
    public function toggle(Request $request, $reviewId)
    {
        $userId = auth()->id();

        $like = ReviewLike::where('user_id', $userId)
                         ->where('review_id', $reviewId)
                         ->first();

        if ($like) {

            $like->delete();
            $liked = false;

        } else {

            ReviewLike::create([
                'user_id' => $userId,
                'review_id' => $reviewId
            ]);

            $liked = true;
        }

        $likesCount = ReviewLike::where('review_id', $reviewId)->count();

        return response()->json(['liked' => $liked, 'likes_count' => $likesCount]);
    }
}
