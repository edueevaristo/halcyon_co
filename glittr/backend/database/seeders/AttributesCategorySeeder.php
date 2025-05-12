<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributesCategorySeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [

            // Pele / Skincare
            'Hidratante facial' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Textura' => [
                    'type' => 'select',
                    'values' => ['Gel', 'Creme', 'Loção', 'Sérum', 'Fluido']
                ],
                'Tem FPS (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Fator de proteção solar (FPS)' => [
                    'type' => 'integer'
                ],
                'Comedogênico (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Vegano (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Cruelty-free (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Fragrância (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],

            'Protetor solar' => [
                'Tipo de proteção (UVA, UVB, ambas)' => [
                    'type' => 'select',
                    'values' => ['UVA', 'UVB', 'Ambas']
                ],
                'Acabamento (matte, glow, natural)' => [
                    'type' => 'select',
                    'values' => ['Matte', 'Glow', 'Natural']
                ],
                'Textura' => [
                    'type' => 'select',
                    'values' => ['Gel', 'Creme', 'Loção', 'Fluido']
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ]
            ],

            'Sérum' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Ativo principal' => [
                    'type' => 'text'
                ],
                'Finalidade (acne, hidratação, antissinais etc.)' => [
                    'type' => 'select',
                    'values' => ['Acne', 'Hidratação', 'Antissinais']
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Uso (diurno/noturno)' => [
                    'type' => 'select',
                    'values' => ['Diurno', 'Noturno']
                ]
            ],
            'Tônico' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (adstringente, calmante, hidratante etc.)' => [
                    'type' => 'select',
                    'values' => ['Adstringente', 'Calmante', 'Hidratante']
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Contém álcool (sim/não)' => [
                    'type' => 'boolean'

                ]
            ],
            'Esfoliante facial' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de esfoliação (física, química, enzimática)' => [
                    'type' => 'select',
                    'values' => ['Física', 'Química', 'Enzimática']
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Ingredientes ativos' => [
                    'type' => 'text'
                ],
                'Frequência de uso' => [
                    'type' => 'text'
                ]
            ],
            'Máscara facial' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (argila, tecido, peel-off etc.)' => [
                    'type' => 'select',
                    'values' => ['Argila', 'Tecido', 'Peel-off']
                ],
                'Função (limpeza, hidratação etc.)' => [
                    'type' => 'text'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ]
            ],

            // Maquiagem
            'Base' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Cobertura (leve, média, alta)' => [
                    'type' => 'select',
                    'values' => ['Leve', 'Média', 'Alta']
                ],
                'Acabamento' => [
                    'type' => 'text'
                ],
                'Textura (líquida, cremosa etc.)' => [
                    'type' => 'text'
                ],
                'FPS' => [
                    'type' => 'integer'
                ],
                'Tons disponíveis' => [
                    'type' => 'text'
                ],
                'Oil-free (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ]
            ],
            'Corretivo' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Cobertura' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Finalidade (olheiras, manchas etc.)' => [
                    'type' => 'select',
                    'values' => ['Olheiras', 'Manchas']
                ],
                'Tonalidades disponíveis' => [
                    'type' => 'integer'
                ]
            ],
            'Primer' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Função (minimizar poros, matificar etc.)' => [
                    'type' => 'select',
                    'values' => ['Minimizar poros', 'Matificar', 'Melhorar textura', 'Melhorar pigmentação']
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Com cor (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ]
            ],
            'Pó (compacto/solto)' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (com cor, translúcido)' => [
                    'type' => 'select',
                    'values' => ['Com cor', 'Translucido']
                ],
                'Acabamento (matte, iluminado)' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ]
            ],
            'Blush / Iluminador / Contorno' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Acabamento' => [
                    'type' => 'text'
                ],
                'Tom (quente, frio, neutro)' => [
                    'type' => 'select',
                    'values' => ['Quente', 'Frio', 'Neutro']
                ]
            ],
            'Sombra' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Pigmentação'   => [
                    'type' => 'text'
                ],
                'Paleta (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Máscara de cílios' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Efeito (volume, alongamento etc.)' => [
                    'type' => 'select',
                    'values' => ['Volume', 'Alongamento', 'Fixação']
                ],
                'À prova d’água (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Cor' => [
                    'type' => 'text'
                ]
            ],
            'Delineador' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (caneta, líquido, gel)' => [
                    'type' => 'select',
                    'values' => ['Caneta', 'Líquido', 'Gel']
                ],
                'Cor' => [
                    'type' => 'text'
                ],
                'Acabamento' => [
                    'type' => 'text'
                ]
            ],
            'Batom / Gloss / Lip tint' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Fixação' => [
                    'type' => 'text'
                ],
                'Hidratação (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Vegano (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Cruelty-free (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Cor' => [
                    'type' => 'text'
                ]
            ],

            // Cabelos
            'Shampoo / Condicionador' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de cabelo' => [
                    'type' => 'select',
                    'values' => ['Seco', 'Oleoso', 'Misto', 'Sensível', 'Normal']
                ],
                'Finalidade (hidratação, crescimento etc.)' => [
                    'type' => 'select',
                    'values' => ['Hidratação', 'Crescimento', 'Reconstrução', 'Reparação']
                ],
                'Contém sulfato (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Contém parabenos (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Fragrância (sim/não) ' => [
                    'type' => 'boolean'
                ]
            ],
            'Máscara capilar' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Etapa do cronograma (hidratação, nutrição, reconstrução)' => [
                    'type' => 'select',
                    'values' => ['Hidratação', 'Nutrição', 'Reconstrução']
                ],
                'Tempo de ação' => [
                    'type' => 'text'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Tipo de cabelo' => [
                    'type' => 'text'
                ]
            ],
            'Leave-in / Finalizador' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Termoproteção (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Antifrizz (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Textura' => [
                    'type' => 'text'
                ],
                'Tipo de cabelo' => [
                    'type' => 'text'
                ]
            ],
            'Óleo capilar' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de óleo' => [
                    'type' => 'select',
                    'values' => ['Seco', 'Oleoso', 'Misto', 'Sensível', 'Normal']
                ],
                'Peso (leve, médio, pesado)' => [
                    'type' => 'select',
                    'values' => ['Leve', 'Médio', 'Pesado']
                ],
                'Uso (umectação, finalização, pré-shampoo)' => [
                    'type' => 'select',
                    'values' => ['Umectação', 'Finalização', 'Pré-shampoo']
                ]
            ],

            // Corpo e Banho
            'Sabonete líquido / barra' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Função (limpeza, hidratação etc.)' => [
                    'type' => 'select',
                    'values' => ['Limpeza', 'Hidratação', 'Reconstrução']
                ],
                'Fragrância (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Contém esfoliante (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Hidratante corporal' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Textura (loção, manteiga etc.)' => [
                    'type' => 'select',
                    'values' => ['Loção', 'Manteiga', 'Creme']
                ],
                'Absorção (rápida/lenta)' => [
                    'type' => 'select',
                    'values' => ['Rápida', 'Lenta']
                ],
                'Fragrância (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Óleo corporal' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Pode usar no banho (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Fixação de fragrância (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],

            // Unhas
            'Esmalte' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (cremoso, metálico, gel etc.)' => [
                    'type' => 'select',
                    'values' => ['Cremoso', 'Metalico', 'Gel', 'Base']
                ],
                'Cor' => [
                    'type' => 'text',
                ],
                'Secagem rápida (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Hipoalergênico (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Tratamento para unhas' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (fortalecedor, óleo, base)' => [
                    'type' => 'select',
                    'values' => ['Fortalecedor', 'Óleo', 'Base']
                ],
                'Com vitaminas (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],

            // Fragrâncias
            'Perfume / Body Splash / Colônia' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Família olfativa (floral, frutal, amadeirada etc.)' => [
                    'type' => 'select',
                    'values' => ['Floral', 'Frutal', 'Amadeirada', 'Fruíta', 'Fruíto', 'Fruíto e frutal']
                ],
                'Concentração (parfum, eau de parfum etc.)' => [
                    'type' => 'select',
                    'values' => ['Parfum', 'Eau de Parfum', 'Eau de Toilette', 'Eau de Toilette de Homme', 'Eau de Toilette de Femme']
                ],
                'Fixação (baixa, média, alta)' => [
                    'type' => 'select',
                    'values' => ['Baixa', 'Média', 'Alta']
                ],
                'Volume (ml)' => [
                    'type' => 'integer'
                ]
            ],

            // Cuidados Masculinos
            'Barbeador / Lâmina' => [
                'Ingredientes (se aplicável)' => [
                    'type' => 'text'
                ],
                'Tipo (descartável, recarregável, elétrico)' => [
                    'type' => 'select',
                    'values' => ['Descartável', 'Recarregável', 'Elétrico']
                ],
                'Número de lâminas' => [
                    'type' => 'integer'
                ],
                'Uso (barba, cabeça, corpo)' => [
                    'type' => 'select',
                    'values' => ['Barba', 'Cabeça', 'Corpo']
                ],
                'Indicado para peles sensíveis (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Espuma / Gel de barbear' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ],
                'Textura (espuma, gel, creme)' => [
                    'type' => 'select',
                    'values' => ['Espuma', 'Gel', 'Creme']
                ],
                'Com ou sem fragrância' => [
                    'type' => 'boolean'
                ],
                'Com ativos calmantes (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Pós-barba / Balm' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (loção, bálsamo, gel)' => [
                    'type' => 'select',
                    'values' => ['Loção', 'Bálsamo', 'Gel']
                ],
                'Contém álcool (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Hidratação (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Calmante (sim/não)'    => [
                    'type' => 'boolean'
                ],
                'Tipo de pele' => [
                    'type' => 'select',
                    'values' => ['Seca', 'Oleosa', 'Mista', 'Sensível', 'Normal']
                ]
            ],
            'Shampoo / Condicionador masculino' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo de cabelo' => [
                    'type' => 'select',
                    'values' => ['Seco', 'Oleoso', 'Misto', 'Sensível', 'Normal']
                ],
                'Finalidade (antiqueda, oleosidade, caspa etc.)' => [
                    'type' => 'select',
                    'values' => ['Antiqueda', 'Oleosidade', 'Caspa']
                ],
                'Fragrância intensa (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Vegano (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
            'Perfume masculino / Body spray' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Família olfativa (amadeirada, cítrica, aromática etc.)' => [
                    'type' => 'select',
                    'values' => ['Amadeirada', 'Cítrica', 'Aromática', 'Fruíta', 'Fruíto', 'Fruíto e frutal']
                ],
                'Concentração (parfum, eau de parfum etc.)' => [
                    'type' => 'select',
                    'values' => ['Parfum', 'Eau de Parfum', 'Eau de Toilette', 'Eau de Toilette de Homme', 'Eau de Toilette de Femme']
                ],
                'Fixação (baixa, média, alta)' => [
                    'type' => 'select',
                    'values' => ['Baixa', 'Média', 'Alta']
                ],
                'Volume (ml)' => [
                    'type' => 'integer'
                ]
            ],
            'Desodorante' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Tipo (aerossol, roll-on, bastão)' => [
                    'type' => 'select',
                    'values' => ['Aerosol', 'Roll-on', 'Bastão']
                ],
                '48h ou mais de proteção (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Antitranspirante (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Sem alumínio (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Com fragrância (sim/não) ' => [
                    'type' => 'boolean'
                ],
            ],
            'Kit barba / cuidados masculinos' => [
                'Ingredientes' => [
                    'type' => 'text'
                ],
                'Produtos inclusos' => [
                    'type' => 'text'
                ],
                'Tipo de uso (barba, cabelo, corpo)' => [
                    'type' => 'select',
                    'values' => ['Barba', 'Cabelo', 'Corpo']
                ],
                'Vegano (sim/não)' => [
                    'type' => 'boolean'
                ],
                'Cruelty-free (sim/não)' => [
                    'type' => 'boolean'
                ]
            ],
        ];

        foreach ($attributes as $subcatName => $attrs) {
            $subcat = Subcategory::where('name', $subcatName)->first();

            if (!$subcat) {
                echo "Subcategoria não encontrada: $subcatName\n";
                continue;
            }

            foreach ($attrs as $name => $info) {
                $type = $info['type'];
                $values = $info['values'] ?? [];

                $attribute = Attribute::create([
                    'subcategory_id' => $subcat->id,
                    'name' => $name,
                    'type' => $type,
                    'is_select' => $type === 'select'
                ]);

                if ($type === 'select' && !empty($values)) {
                    foreach ($values as $value) {
                        AttributeValue::create([
                            'attribute_id' => $attribute->id,
                            'value' => $value
                        ]);
                    }
                }
            }
        }

    }
}
