<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function checkPremiumStatus()
    {
        $user = Auth::guard('sanctum')->user();
        
        return response()->json([
            'is_premium' => $user->is_premium,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_premium' => $user->is_premium
            ]
        ]);
    }
}