<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumAccessController extends Controller
{
    public function checkAccess(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }

        return response()->json([
            'has_access' => $user->is_premium,
            'user_info' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_premium' => $user->is_premium
            ]
        ]);
    }

    public function getObfuscatedData(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        
        if ($user && $user->is_premium) {
            return response()->json(['message' => 'Usuário premium tem acesso completo'], 200);
        }

        return response()->json([
            'obfuscated' => true,
            'message' => 'Conteúdo disponível apenas para usuários premium',
            'user_info' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ] : null
        ]);
    }
}