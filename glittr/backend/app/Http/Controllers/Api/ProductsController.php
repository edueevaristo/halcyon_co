<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Validation\ValidationException;

class ProductsController extends Controller
{
    public function insert(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'type_of_coverage' => 'nullable|string|max:255',
            'type_of_finish' => 'nullable|string|max:255',
            'fps' => 'nullable|integer|min:0',
            'available_tones' => 'nullable|string',
            'oil_free' => 'boolean',
            'price_average' => 'nullable|numeric',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
            'image_path' => 'nullable|string',
        ]);

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product criado com sucesso!',
            'product' => $product
        ], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->id);

        $validated = $request->validate([
            'product_name' => 'sometimes|string|max:255',
            'brand' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_id' => 'sometimes|exists:subcategories,id',
            'type_of_coverage' => 'nullable|string|max:255',
            'type_of_finish' => 'nullable|string|max:255',
            'fps' => 'nullable|integer|min:0',
            'available_tones' => 'nullable|string',
            'oil_free' => 'boolean',
            'price_average' => 'nullable|numeric',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
            'image_path' => 'nullable|string',
        ]);

        $product->update($validated);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product
        ], 200);
    }
}
