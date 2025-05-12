<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
//        $categories = [
//            '🧴 Pele / Skincare',
//            '💄 Maquiagem',
//            '🧖‍♀️ Cabelos',
//            '🚿 Corpo e Banho',
//            '💅 Unhas',
//            '🌸 Fragrâncias',
//            '🧔 Cuidados Masculinos',
//        ];

        $peleSkincareCategory = Category::where('name', '🧴 Pele / Skincare')->first()->id;
        $maquiagemCategory   = Category::where('name', '💄 Maquiagem')->first()->id;
        $cabelosCategory  = Category::where('name', '🧖‍♀️ Cabelos')->first()->id;
        $corpoBanhoCategory  = Category::where('name', '🚿 Corpo e Banho')->first()->id;
        $unhasCategory  = Category::where('name', '💅 Unhas')->first()->id;
        $fragranciasCategory  = Category::where('name', '🌸 Fragrâncias')->first()->id;
        $cuidadosMasculinosCategory = Category::where('name', '🧔 Cuidados Masculinos')->first()->id;

        $subcategories = [

            /* Pele / Skincare */
            ['name' => 'Hidratante facial',  'category_id' => $peleSkincareCategory],
            ['name' => 'Protetor solar',     'category_id' => $peleSkincareCategory],
            ['name' => 'Sérum',              'category_id' => $peleSkincareCategory],
            ['name' => 'Tônico',             'category_id' => $peleSkincareCategory],
            ['name' => 'Esfoliante facial',  'category_id' => $peleSkincareCategory],
            ['name' => 'Máscara facial',     'category_id' => $peleSkincareCategory],

            /* Maquiagem */
            ['name' => 'Base',  'category_id' => $maquiagemCategory],
            ['name' => 'Corretivo',  'category_id' => $maquiagemCategory],
            ['name' => 'Primer',  'category_id' => $maquiagemCategory],
            ['name' => 'Pó (compacto/solto)',  'category_id' => $maquiagemCategory],
            ['name' => 'Blush / Iluminador / Contorno',  'category_id' => $maquiagemCategory],
            ['name' => 'Sombra',  'category_id' => $maquiagemCategory],
            ['name' => 'Máscara de cílios',  'category_id' => $maquiagemCategory],
            ['name' => 'Delineador',  'category_id' => $maquiagemCategory],
            ['name' => 'Batom / Gloss / Lip tint',  'category_id' => $maquiagemCategory],

            /* Cabelos */
            ['name' => 'Shampoo / Condicionador',  'category_id' => $cabelosCategory],
            ['name' => 'Máscara capilar',  'category_id' => $cabelosCategory],
            ['name' => 'Leave-in / Finalizador',  'category_id' => $cabelosCategory],
            ['name' => 'Óleo capilar',  'category_id' => $cabelosCategory],

            /* Corpo e Banho */
            ['name' => 'Sabonete líquido / barra',  'category_id' => $corpoBanhoCategory],
            ['name' => 'Hidratante corporal',  'category_id' => $corpoBanhoCategory],
            ['name' => 'Óleo corporal',  'category_id' => $corpoBanhoCategory],

            /* Unhas */
            ['name' => 'Esmalte',  'category_id' => $unhasCategory],
            ['name' => 'Tratamento para unhas',  'category_id' => $unhasCategory],

            /* Fragrâncias */
            ['name' => 'Perfume / Body Splash / Colônia',  'category_id' => $fragranciasCategory],

            /* Cuidados masculinos */
            ['name' => 'Barbeador / Lâmina',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Espuma / Gel de barbear',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Pós-barba / Balm',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Shampoo / Condicionador masculino',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Perfume masculino / Body spray',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Desodorante',  'category_id' => $cuidadosMasculinosCategory],
            ['name' => 'Kit barba / cuidados masculinos',  'category_id' => $cuidadosMasculinosCategory]

        ];

        foreach ($subcategories as $sub) {
            Subcategory::create($sub);
        }
    }
}
