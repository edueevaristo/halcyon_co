<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function index($productId)
    {
        $reviews = ProductReview::with(['user', 'likes', 'replies.user'])
            ->where('product_id', $productId)
            ->orderByDesc('created_at')
            ->get();

        // Tenta pegar o usuário autenticado (pode ser null se não estiver logado)
        $userId = auth('sanctum')->id();

        $reviews->each(function ($review) use ($userId) {

            if ($review->user) {

                $review->user->profile_image_url = $review->user->profile_image_url;
            }

            // Adiciona informações de likes
            $review->likes_count = $review->likes->count();
            $review->is_liked = $userId ? $review->likes->contains('user_id', $userId) : false;

            // Adiciona informações de replies
            $review->replies_count = $review->replies->count();
            $review->can_like = $userId && $review->user_id !== $userId; // Não pode dar like na própria avaliação

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

    public function show($id)
    {
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
