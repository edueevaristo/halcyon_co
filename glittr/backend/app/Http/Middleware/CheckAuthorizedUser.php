<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthorizedUser
{
    private $authorizedEmails = [
        'eduardo.evaristo@glittr.com.br',
        'amanda.vieira@glittr.com.br',
        'joao.pedro@glittr.com.br',
        'jenifer.goncalves@glittr.com.br',
        'daniel.oliveira@glittr.com.br'
    ];

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('sanctum')->user();
        
        if (!$user || !in_array($user->email, $this->authorizedEmails)) {
            return response()->json(['message' => 'Acesso não autorizado'], 403);
        }

        return $next($request);
    }
}