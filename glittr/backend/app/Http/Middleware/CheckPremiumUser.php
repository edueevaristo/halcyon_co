<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPremiumUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('sanctum')->user();
        
        if (!$user || !$user->is_premium) {
            return response()->json(['message' => 'Acesso restrito a usuários premium'], 403);
        }

        return $next($request);
    }
}
