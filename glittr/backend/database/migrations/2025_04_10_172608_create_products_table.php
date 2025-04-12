<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * @description Tabela de Marcas
         * Campo:
         *      - name (Responsável por armazenar o nome da marca)
         *      - active (Responsável por armazenar se a marca está ativa ou não)
         */
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Tipos de Pele
         * Campo:
         *      - name (Responsável por armazenar o nome do tipo de pele)
         *      - active (Responsável por armazenar se o tipo de pele está ativo ou nao)
         */
        Schema::create('skin_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Texturas
         * Campo:
         *      - name (Responsável por armazenar o nome da textura)
         *      - active (Responsável por armazenar se a textura esta ativa ou nao)
         */
        Schema::create('textures', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Hidratantes Faciais
         * Campos:
         *      - brand_id (Responsável por armazenar o id da marca)
         *      - average_price (Responsável por armazenar o preço médio)
         *      - ingredients (Responsável por armazenar os ingredientes)
         *      - skin_type_id (Responsável por armazenar o id do tipo de pele)
         *      - texture_id (Responsável por armazenar o id da textura)
         *      - has_spf (Responsável por armazenar se possui SPF)
         *      - spf (Responsável por armazenar o SPF)
         *      - comedogenic (Responsável por armazenar se são comedogénicos)
         *      - vegan (Responsável por armazenar se é vegano)
         *      - cruelty_free (Responsável por armazenar se é cruelty free)
         *      - fragrance (Responsável por armazenar se possui fragrancias)
         *      - active (Responsável por armazenar se o hidratante facial esta ativa ou nao)
         */
        Schema::create('facial_moisturizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->boolean('has_spf')->default(false);
            $table->integer('spf')->nullable();
            $table->boolean('comedogenic')->default(false);
            $table->boolean('vegan')->default(false);
            $table->boolean('cruelty_free')->default(false);
            $table->boolean('fragrance')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Protetores Solares
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - spf (Fator de proteção solar)
         *      - protection_type (Tipo de proteção)
         *      - finish (Acabamento)
         *      - texture_id (ID da textura)
         *      - water_resistant (Resistente à água)
         *      - tinted (Com cor)
         *      - skin_type_id (ID do tipo de pele)
         *      - active (Responsável por armazenar se o protetor solar está ativo ou nao)
         */
        Schema::create('sunscreens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->integer('spf');
            $table->string('protection_type', 50)->nullable();
            $table->string('finish', 50)->nullable();
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->boolean('water_resistant')->default(false);
            $table->boolean('tinted')->default(false);
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Seruns
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - main_active (Ativo principal)
         *      - purpose (Finalidade)
         *      - texture_id (ID da textura)
         *      - skin_type_id (ID do tipo de pele)
         *      - usage (Uso diurno ou noturno)
         *      - active (Responsável por armazenar se o serum está ativo ou nao)
         */
        Schema::create('serums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('main_active', 100)->nullable();
            $table->string('purpose', 100)->nullable();
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->enum('usage', ['day', 'night']);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Máscaras Faciais
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - type (Tipo)
         *      - function (Função)
         *      - skin_type_id (ID do tipo de pele)
         *      - active (Responsável por armazenar se a mascara facial está ativa ou nao)
         */
        Schema::create('facial_masks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('function', 50)->nullable();
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Bases
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - coverage (Cobertura)
         *      - finish (Acabamento)
         *      - texture_id (ID da textura)
         *      - spf (FPS)
         *      - available_shades (Tons disponíveis)
         *      - oil_free (Livre de óleo)
         *      - skin_type_id (ID do tipo de pele)
         *      - active (Responsável por armazenar se a base está ativa ou nao)
         */
        Schema::create('foundations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->enum('coverage', ['light', 'medium', 'high']);
            $table->string('finish', 50)->nullable();
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->integer('spf')->nullable();
            $table->integer('available_shades')->nullable();
            $table->boolean('oil_free')->default(false);
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Corretivos
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - coverage (Cobertura)
         *      - texture_id (ID da textura)
         *      - purpose (Finalidade)
         *      - available_shades (Tonalidades disponíveis)
         *      - active (Responsável por armazenar se o concealer está ativo ou nao)
         */
        Schema::create('concealers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('coverage', 50)->nullable();
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->string('purpose', 100)->nullable();
            $table->integer('available_shades')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Batons
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - texture_id (ID da textura)
         *      - lasting (Fixação)
         *      - hydrating (Hidratação)
         *      - vegan (Vegano)
         *      - cruelty_free (Cruelty free)
         *      - color (Cor)
         *      - active (Responsável por armazenar se o baton está ativo ou nao)
         */
        Schema::create('lipsticks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->foreignId('texture_id')->nullable()->constrained('textures');
            $table->string('lasting', 100)->nullable();
            $table->boolean('hydrating')->default(false);
            $table->boolean('vegan')->default(false);
            $table->boolean('cruelty_free')->default(false);
            $table->string('color', 100)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Shampoos e Condicionadores
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - hair_type (Tipo de cabelo)
         *      - purpose (Finalidade)
         *      - contains_sulfate (Contém sulfato)
         *      - contains_parabens (Contém parabenos)
         *      - fragrance (Fragrância)
         *      - active (Responsável por armazenar se o shampoo ou condicionador está ativo, ou nao)
         */
        Schema::create('shampoos_conditioners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('hair_type', 100)->nullable();
            $table->string('purpose', 100)->nullable();
            $table->boolean('contains_sulfate')->default(false);
            $table->boolean('contains_parabens')->default(false);
            $table->boolean('fragrance')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Sabonetes
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - skin_type_id (ID do tipo de pele)
         *      - function (Função)
         *      - fragrance (Fragrância)
         *      - contains_exfoliant (Contém esfoliante)
         *      - active (Responsável por armazenar se o sabonete está ativo ou nao)
         */
        Schema::create('soaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->foreignId('skin_type_id')->nullable()->constrained('skin_types');
            $table->string('function', 100)->nullable();
            $table->boolean('fragrance')->default(false);
            $table->boolean('contains_exfoliant')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Esmaltes
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - type (Tipo)
         *      - color (Cor)
         *      - quick_dry (Secagem rápida)
         *      - hypoallergenic (Hipoalergênico)
         *      - active (Responsável por armazenar se o esmalte está ativo ou nao)
         */
        Schema::create('nail_polishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('color', 50)->nullable();
            $table->boolean('quick_dry')->default(false);
            $table->boolean('hypoallergenic')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Perfumes
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - ingredients (Ingredientes)
         *      - olfactory_family (Família olfativa)
         *      - concentration (Concentração)
         *      - lasting (Fixação)
         *      - volume_ml (Volume em ml)
         *      - active (Responsável por armazenar se o perfume está ativo ou nao)
         */
        Schema::create('perfumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('olfactory_family', 50)->nullable();
            $table->string('concentration', 50)->nullable();
            $table->string('lasting', 50)->nullable();
            $table->integer('volume_ml')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        /**
         * @description Tabela de Barbeadores
         * Campos:
         *      - brand_id (ID da marca)
         *      - average_price (Preço médio)
         *      - type (Tipo)
         *      - blade_count (Número de lâminas)
         *      - usage (Uso)
         *      - sensitive_skin (Indicado para peles sensíveis)
         *      - active (Responsável por armazenar se o barbeador está ativo ou nao)
         */
        Schema::create('razors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands');
            $table->decimal('average_price', 10)->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('blade_count')->nullable();
            $table->string('usage', 100)->nullable();
            $table->boolean('sensitive_skin')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razors');
        Schema::dropIfExists('perfumes');
        Schema::dropIfExists('nail_polishes');
        Schema::dropIfExists('soaps');
        Schema::dropIfExists('shampoos_conditioners');
        Schema::dropIfExists('lipsticks');
        Schema::dropIfExists('concealers');
        Schema::dropIfExists('foundations');
        Schema::dropIfExists('facial_masks');
        Schema::dropIfExists('serums');
        Schema::dropIfExists('sunscreens');
        Schema::dropIfExists('facial_moisturizers');
        Schema::dropIfExists('textures');
        Schema::dropIfExists('skin_types');
        Schema::dropIfExists('brands');
    }

};
