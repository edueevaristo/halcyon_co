<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function sendPremiumRequest(Request $request)
    {
        $request->validate([
            'action' => 'required|string',
        ]);

        $user = Auth::guard('sanctum')->user();
        
        $data = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'action' => $request->action,
            'requested_at' => now()->format('d/m/Y H:i:s'),
        ];

        Mail::send('emails.premium-request', $data, function ($message) {
            $message->to('contato@glittr.com.br')
                    ->subject('Solicitação de Acesso Premium');
        });

        return response()->json(['message' => 'Solicitação enviada com sucesso!']);
    }
}