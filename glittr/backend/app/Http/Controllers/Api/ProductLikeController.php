<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductLike;
use Illuminate\Http\Request;

class ProductLikeController extends Controller
{
    public function toggle(Request $request, $productId)
    {
        $isPremium = $request->get('is_premium_user', false);
        $userInfo = $request->get('user_info', null);
        
        if (!$isPremium) {
            return response()->json([
                'obfuscated' => true,
                'message' => 'Likes disponíveis apenas para usuários premium',
                'action' => 'product_like',
                'user_info' => $userInfo
            ], 403);
        }

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
