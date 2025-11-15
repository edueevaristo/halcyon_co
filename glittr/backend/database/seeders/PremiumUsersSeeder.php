<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class PremiumUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder removido - controle premium agora é manual
        // Para definir usuários premium, use:
        // User::where('email', 'email@exemplo.com')->update(['is_premium' => true]);
    }
}