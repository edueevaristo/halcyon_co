<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPremiumOrObfuscate
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('sanctum')->user();
        
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }

        // Adiciona informação sobre o status premium na request
        $request->merge(['is_premium_user' => $user->is_premium]);
        $request->merge(['user_info' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_premium' => $user->is_premium
        ]]);

        return $next($request);
    }
}