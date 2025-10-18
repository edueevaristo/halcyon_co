<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductLike;
use Illuminate\Http\Request;

class ProductLikeController extends Controller
{
    public function toggle(Request $request, $productId)
    {
        $userId = auth()->id();
        $like = ProductLike::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($like) {

            $like->delete();
            $liked = false;

        } else {

            ProductLike::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);

            $liked = true;
        }

        $likesCount = ProductLike::where('product_id', $productId)->count();

        return response()->json(['liked' => $liked, 'likes_count' => $likesCount]);
    }
}
