<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('description');
            $table->string('brand');

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');

            $table->decimal('price_average', 8, 2)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('product_link')->nullable();

            // Alterado para json (mais eficiente para queries com JSON)
            $table->json('image_path')->nullable();

            // Alterado para json (recomendado para armazenar estruturas JSON)
            $table->json('attributes')->nullable();

            $table->timestamps();

            $table->index('product_name');
            $table->index('brand');
            $table->index('category_id');
            $table->index('subcategory_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
