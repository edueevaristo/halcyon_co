<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index(Request $request, $productId)
    {
        $isPremium = $request->get('is_premium_user', false);
        $userInfo = $request->get('user_info', null);
        
        if (!$isPremium) {
            return response()->json([
                'obfuscated' => true,
                'message' => 'Reviews disponíveis apenas para usuários premium',
                'action' => 'reviews',
                'user_info' => $userInfo
            ]);
        }

        $reviews = ProductReview::with(['user', 'likes', 'replies.user'])
            ->where('product_id', $productId)
            ->orderByDesc('created_at')
            ->get();

        $userId = auth('sanctum')->id();

        $reviews->each(function ($review) use ($userId) {
            if ($review->user) {
                $review->user->profile_image_url = $review->user->profile_image_url;
            }

            $review->likes_count = $review->likes->count();
            $review->is_liked = $userId ? $review->likes->contains('user_id', $userId) : false;
            $review->replies_count = $review->replies->count();
            $review->can_like = $userId && $review->user_id !== $userId;

            unset($review->likes);
        });

        return $reviews;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'comment' => 'required|string|max:1000',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $review = ProductReview::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
            'stars' => $request->stars,
        ]);

        return response()->json($review->load('user'), 201);
    }

    public function show(Request $request, $id)
    {
        $isPremium = $request->get('is_premium_user', false);
        $userInfo = $request->get('user_info', null);
        
        if (!$isPremium) {
            return response()->json([
                'obfuscated' => true,
                'message' => 'Detalhes do review disponíveis apenas para usuários premium',
                'action' => 'review_details',
                'user_info' => $userInfo
            ]);
        }

        return ProductReview::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $review = ProductReview::findOrFail($id);

        if ($review->user_id !== Auth::id()) {

            return response()->json(['error' => 'Usuário não autorizado.'], 403);
        }

        $request->validate([
            'comment' => 'string|max:1000',
            'stars' => 'integer|min:1|max:5',
        ]);

        $review->update($request->only('comment', 'stars'));

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = ProductReview::findOrFail($id);

        if ($review->user_id !== Auth::id()) {

            return response()->json(['error' => 'Usuário não autorizado.'], 403);
        }

        $review->delete();

        return response()->json(null, 204);
    }
}
