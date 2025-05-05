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
            $table->string('brand');

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade');

            $table->enum('type_of_coverage', ['Alta', 'Média', 'Baixa'])->nullable();
            $table->enum('type_of_finish', ['Alta', 'Média', 'Baixa'])->nullable();
            $table->string('fps')->nullable();
            $table->integer('available_tones')->nullable();
            $table->boolean('oil_free')->default(false);

            $table->decimal('price_average', 8, 2)->nullable();
            $table->text('ingredients')->nullable();
            $table->string('product_link')->nullable();

            $table->jsonb('image_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
