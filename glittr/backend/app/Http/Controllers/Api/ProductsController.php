<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Log;

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
                $imagePaths[] = $path;
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
            'description' => 'nullable|string',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'price_average' => 'nullable|numeric|min:0',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
            'attributes' => 'nullable',
            'image_path' => 'nullable|array',
        ]);

        if ($request->has('image_path') && is_array($request->image_path)) {
            $imagePaths = $request->image_path;
        } else {
            $imageValidation = $this->validateImageFiles($request);
            if ($imageValidation instanceof JsonResponse) {
                return $imageValidation;
            }
            $imagePaths = $this->storeImages($request);
        }

        $attributes = [];

        if (!empty($validated['attributes'])) {
            if (is_string($validated['attributes'])) {
                try {
                    $attributes = json_decode($validated['attributes'], true);
                } catch (Exception $e) {
                    Log::error('Falha ao decodificar JSON de atributos', [
                        'error' => $e->getMessage(),
                        'attributes' => $validated['attributes']
                    ]);
                }
            } elseif (is_array($validated['attributes'])) {
                $attributes = $validated['attributes'];
            }
        }

        $validatedAttributes = [];

        if (!empty($attributes)) {
            foreach ($attributes as $attr) {
                if (isset($attr['value']['name']) && is_array($attr['value'])) {
                    $validatedAttributes[] = [
                        'name' => $attr['value']['name'],
                        'value' => $attr['value']['value']
                    ];
                } else {
                    $validatedAttributes[] = [
                        'name' => $attr['name'],
                        'value' => $attr['value']
                    ];
                }
            }
        }

        $productData = array_merge($validated, [
            'image_path' => json_encode($imagePaths),
            'attributes' => !empty($validatedAttributes) ? json_encode($validatedAttributes) : null,
        ]);

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
            'description' => 'nullable|string',
            'brand' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'subcategory_id' => 'sometimes|exists:subcategories,id',
            'attributes' => 'nullable|array',
            'price_average' => 'nullable|numeric|min:0',
            'ingredients' => 'nullable|string',
            'product_link' => 'nullable|url',
            'image_path' => 'nullable|array',
        ]);

        if ($request->has('image_path') && is_array($request->image_path)) {
            $imagePaths = $request->image_path;
        } else {
            $this->validateImageFiles($request);
            $imagePaths = $this->storeImages($request, $product);
            $imagePaths = $this->deleteRemovedImages($request, $imagePaths);
        }

        $attributes = $request->input('attributes') ?? [];

        if (is_string($attributes)) {
            $attributes = json_decode($attributes, true) ?? [];
        }

        $validatedAttributes = [];

        if (!empty($attributes)) {
            foreach ($attributes as $attr) {
                if (isset($attr['value']['name']) && is_array($attr['value'])) {
                    $validatedAttributes[] = [
                        'name' => $attr['value']['name'],
                        'value' => $attr['value']['value']
                    ];
                } else {
                    $validatedAttributes[] = [
                        'name' => $attr['name'],
                        'value' => $attr['value']
                    ];
                }
            }
        }

        $updateData = array_merge($validated, [
            'image_path' => json_encode($imagePaths),
            'attributes' => !empty($validatedAttributes) ? json_encode($validatedAttributes) : null,
        ]);

        $product->update($updateData);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product
        ], 200);
    }

    public function index(Request $request)
    {
        $user = auth('sanctum')->user();
        $isPremium = $user ? (bool)$user->is_premium : false;
        $perPage = $request->get('per_page', 12);
        
        $query = Product::with(['category', 'subcategory']);
        
        if (!$isPremium) {
            $query->limit(10);
        }
        
        $products = $isPremium ? $query->paginate($perPage) : $query->get();
        $totalProducts = Product::count();
        $hasMoreProducts = !$isPremium && $totalProducts > 10;

        $responseData = [
            'data' => ($isPremium ? $products->getCollection() : $products)->map(function ($product) use ($isPremium) {
                return $this->formatProductResponse($product, $isPremium);
            }),
            'user_is_premium' => $isPremium
        ];
        
        if ($isPremium) {
            $responseData = array_merge($responseData, [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total()
            ]);
        } else {
            $responseData = array_merge($responseData, [
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => 10,
                'total' => 10,
                'actual_total' => $totalProducts,
                'has_more_products' => $hasMoreProducts
            ]);
        }
        
        return response()->json($responseData, 200);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'subcategory', 'reviews'])->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Produto não encontrado.'
            ], 404);
        }
        
        // Verificar se o usuário está autenticado
        $user = auth('sanctum')->user();
        $isPremium = $user ? (bool)$user->is_premium : false;

        return response()->json([
            'product' => $this->formatProductResponse($product, $isPremium),
            'user_is_premium' => $isPremium
        ], 200);
    }

    public function showByCategory($category)
    {
        $user = auth('sanctum')->user();
        $isPremium = $user ? $user->is_premium : false;
        
        $query = Product::with(['category', 'subcategory'])->where('category_id', $category);
        
        if (!$isPremium) {
            $query->limit(10);
        }
        
        $products = $query->get();
        $totalInCategory = Product::where('category_id', $category)->count();
        $hasMoreProducts = !$isPremium && $totalInCategory > 10;

        return response()->json([
            'products' => $products->map(function ($product) use ($isPremium) {
                return $this->formatProductResponse($product, $isPremium);
            }),
            'total_in_category' => $totalInCategory,
            'has_more_products' => $hasMoreProducts,
            'user_is_premium' => $isPremium
        ], 200);
    }

    public function showBySubcategory($category, $subcategory)
    {
        $user = auth('sanctum')->user();
        $isPremium = $user ? $user->is_premium : false;
        
        $query = Product::with(['category', 'subcategory'])
            ->where('category_id', $category)
            ->where('subcategory_id', $subcategory);
        
        if (!$isPremium) {
            $query->limit(10);
        }
        
        $products = $query->get();
        $totalInSubcategory = Product::where('category_id', $category)
            ->where('subcategory_id', $subcategory)->count();
        $hasMoreProducts = !$isPremium && $totalInSubcategory > 10;

        return response()->json([
            'products' => $products->map(function ($product) use ($isPremium) {
                return $this->formatProductResponse($product, $isPremium);
            }),
            'total_in_subcategory' => $totalInSubcategory,
            'has_more_products' => $hasMoreProducts,
            'user_is_premium' => $isPremium
        ], 200);
    }

    protected function formatProductResponse($product, $isPremium = null)
    {
        $userId = auth('sanctum')->id();
        $user = auth('sanctum')->user();
        $reviews = $product->reviews;
        $avgRating = $reviews->avg('stars') ?? 0;
        
        // Se não foi passado o status premium, verifica do usuário
        if ($isPremium === null) {
            $isPremium = $user ? $user->is_premium : false;
        }

        $response = [
            'id' => $product->id,
            'product_name' => $product->product_name,
            'description' => $product->description,
            'brand' => $product->brand,
            'category' => $product->category,
            'subcategory' => $product->subcategory,
            'attributes' => $product->attributes ?? [],
            'image_path' => $product->image_path ?? [],
            'price_average' => $product->price_average,
            'ingredients' => $product->ingredients,
            'product_link' => $product->product_link,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at,
        ];
        
        // Informações de likes e reviews (premium ou ofuscadas)
        if ($isPremium) {
            $response['likes_count'] = $product->likes()->count();
            $response['is_liked'] = $userId ? $product->isLikedBy($userId) : false;
            $response['reviews_count'] = $product->reviews()->count();
            $response['average_rating'] = round($avgRating, 1);
        } else {
            $response['likes_count'] = '***';
            $response['is_liked'] = false;
            $response['reviews_count'] = '***';
            $response['average_rating'] = '***';
            $response['premium_required'] = true;
        }
        
        return $response;
    }
}