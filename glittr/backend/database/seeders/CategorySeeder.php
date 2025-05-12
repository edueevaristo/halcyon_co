<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            '🧴 Pele / Skincare',
            '💄 Maquiagem',
            '🧖‍♀️ Cabelos',
            '🚿 Corpo e Banho',
            '💅 Unhas',
            '🌸 Fragrâncias',
            '🧔 Cuidados Masculinos',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
