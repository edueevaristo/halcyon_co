<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    protected function validateImageFiles(Request $request)
    {
        return $request->validate([
            'image_files' => 'nullable|array',
            'image_files.*' => 'image|max:2048',
        ]);
    }

    protected function storeImages(Request $request)
    {
        $imagePaths = [];

        if ($request->hasFile('image_files')) {

            foreach ($request->file('image_files') as $image) {

                $storedPath = $image->store('products', 'public');
                $fullUrl = asset('storage/' . $storedPath);
                $imagePaths[] = $fullUrl;
            }
        }

        foreach($imagePaths as &$image) {
            $image = str_replace('/storage/h', 'h', $image);
        }

        return $imagePaths;
    }

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
        ]);

        $this->validateImageFiles($request);
        $imagePaths = $this->storeImages($request);

        $validated['image_path'] = $imagePaths;
        $product = Product::create($validated);

        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'product' => $product
        ], 201);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->id);

        // Valida os dados do produto
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
        ]);

        // Se houver novas imagens, armazena as imagens
        $imagePaths = json_decode($product->image_path ?? '[]', true);

        if ($request->hasFile('image_files')) {

            $this->validateImageFiles($request);
            $newImagePaths = $this->storeImages($request);
            $imagePaths = array_merge($imagePaths, $newImagePaths);
        }

        $validated['image_path'] = $imagePaths;
        $product->update($validated);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product
        ], 200);
    }

    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado.'
            ], 404);
        }

        return response()->json(['product' => $product], 200);
    }

}
