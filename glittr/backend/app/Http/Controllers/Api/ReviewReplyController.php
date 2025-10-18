<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReviewReply;
use Illuminate\Http\Request;

class ReviewReplyController extends Controller
{
    public function store(Request $request, $reviewId)
    {
        $request->validate([
            'reply' => 'required|string|max:1000'
        ]);

        $reply = ReviewReply::create([
            'user_id' => auth()->id(),
            'review_id' => $reviewId,
            'reply' => $request->reply
        ]);

        $reply->load('user');

        return response()->json([
            'message' => 'Resposta adicionada com sucesso',
            'reply' => [
                'id' => $reply->id,
                'reply' => $reply->reply,
                'created_at' => $reply->created_at,
                'user' => [
                    'id' => $reply->user->id,
                    'name' => $reply->user->name,
                    'profile_image_url' => $reply->user->profile_image_url
                ]
            ]
        ], 201);
    }

    public function index($reviewId)
    {
        $replies = ReviewReply::where('review_id', $reviewId)
                             ->with(['user', 'likes'])
                             ->orderBy('created_at', 'asc')
                             ->get();

        $userId = auth('sanctum')->id();

        return response()->json([
            'replies' => $replies->map(function($reply) use ($userId) {
                return [
                    'id' => $reply->id,
                    'reply' => $reply->reply,
                    'created_at' => $reply->created_at,
                    'likes_count' => $reply->likes->count(),
                    'is_liked' => $userId ? $reply->likes->contains('user_id', $userId) : false,
                    'can_like' => $userId && $reply->user_id !== $userId,
                    'user' => [
                        'id' => $reply->user->id,
                        'name' => $reply->user->name,
                        'profile_image_url' => $reply->user->profile_image_url
                    ]
                ];
            })
        ]);
    }

    public function getMentionableUsers($productId)
    {
        $productLikers = \App\Models\ProductLike::where('product_id', $productId)
                                                ->with('user')
                                                ->get()
                                                ->pluck('user')
                                                ->filter();

        $reviewers = \App\Models\ProductReview::where('product_id', $productId)
                                             ->with('user')
                                             ->get()
                                             ->pluck('user')
                                             ->filter();

        $repliers = \App\Models\ReviewReply::whereHas('review', function($query) use ($productId) {
                                                $query->where('product_id', $productId);
                                            })
                                           ->with('user')
                                           ->get()
                                           ->pluck('user')
                                           ->filter();

        $users = $productLikers->merge($reviewers)->merge($repliers)->unique('id')->values();

        return response()->json([
            'users' => $users->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'profile_image_url' => $user->profile_image_url
                ];
            })
        ]);
    }
}
