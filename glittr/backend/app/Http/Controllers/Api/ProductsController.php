<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    protected function validateImageFiles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image_files' => 'nullable|array',
            'image_files.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $validator->validated();
    }

    protected function storeImages(Request $request, $product = null)
    {
        $imagePaths = [];

        if ($product && $product->image_path) {

            $imagePaths = json_decode($product->image_path, true) ?? [];
        }

        if ($request->hasFile('image_files')) {

            foreach ($request->file('image_files') as $image) {

                $path = $image->store('products', 'public');
                $imagePaths[] = Storage::url($path);
            }
        }

        return $imagePaths;
    }

    protected function deleteRemovedImages(Request $request, $currentImages)
    {
        if ($request->has('removed_images')) {

            $removedImages = json_decode($request->removed_images, true) ?? [];

            foreach ($removedImages as $imageUrl) {

                $path = str_replace('/storage/', '', parse_url($imageUrl, PHP_URL_PATH));
                Storage::disk('public')->delete($path);


                $currentImages = array_filter($currentImages, function ($img) use ($imageUrl) {
                    return $img !== $imageUrl;
                });
            }
        }

        return array_values($currentImages);
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price_average' => 'nullable|numeric|min:0',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
        ]);

        // Valida imagens
        $imageValidation = $this->validateImageFiles($request);

        if ($imageValidation instanceof \Illuminate\Http\JsonResponse) {

            return $imageValidation;
        }

        $imagePaths = $this->storeImages($request);
        $attributes = [];

        if ($request->input('attributes')) {

            $attributes = $request->input('attributes');

            if (is_string($attributes)) {

                $attributes = json_decode($attributes, true) ?? [];
            }

            $attributes = array_filter($attributes, function ($value) {
                return $value !== '' || is_bool($value);
            });
        }

        \Log::info('Atributos recebidos:', ['raw' => $request->input('attributes'), 'processed' => $attributes]);

        $productData = array_merge($validated, [
            'image_path' => json_encode($imagePaths),
            'attributes' => !empty($attributes) ? $attributes : null,
        ]);

        \Log::info('Dados completos do produto:', $productData);

        $product = Product::create($productData);

        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'product' => $product,
            'received_attributes' => $attributes
        ], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->id);

        $validated = $request->validate([
            'product_name' => 'sometimes|string|max:255',
            'brand' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_id' => 'sometimes|exists:subcategories,id',
            'attributes' => 'nullable|json',
            'price_average' => 'nullable|numeric|min:0',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
        ]);

        // Valida imagens
        $this->validateImageFiles($request);

        // Processa imagens
        $imagePaths = $this->storeImages($request, $product);
        $imagePaths = $this->deleteRemovedImages($request, $imagePaths);

        // Decodifica os atributos dinâmicos
        $attributes = json_decode($request->attributes, true) ?? [];

        $updateData = array_merge($validated, [
            'image_path' => json_encode($imagePaths),
            'attributes' => json_encode($attributes),
        ]);

        $product->update($updateData);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product
        ], 200);
    }

    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->get();
        return response()->json([
            'products' => $products->map(function ($product) {
                return $this->formatProductResponse($product);
            })
        ], 200);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'subcategory'])->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado.'
            ], 404);
        }

        return response()->json([
            'product' => $this->formatProductResponse($product)
        ], 200);
    }

    protected function formatProductResponse($product)
    {
        return [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'brand' => $product->brand,
            'category' => $product->category,
            'subcategory' => $product->subcategory,
            'attributes' => json_decode($product->attributes, true) ?? [],
            'image_path' => json_decode($product->image_path, true) ?? [],
            'price_average' => $product->price_average,
            'ingredients' => $product->ingredients,
            'product_link' => $product->product_link,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];
    }
}
