<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\ProductReviewController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\Api\ReviewLikeController;
use App\Http\Controllers\Api\ReplyLikeController;
use App\Http\Controllers\Api\ReviewReplyController;
use App\Http\Controllers\Api\ProductLikeController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PremiumAccessController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
});

Route::middleware(['auth:sanctum'])->prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
    Route::get('show/category/{id}', [ProductsController::class, 'showByCategory']);
    Route::get('show/subcategory/{category}/{subcategory}', [ProductsController::class, 'showBySubcategory']);
});

// Rotas premium para produtos
Route::middleware(['auth:sanctum', 'premium'])->prefix('products')->group(function () {
    Route::post('/', [ProductsController::class, 'insert']);
    Route::put('/', [ProductsController::class, 'update']);
});

Route::middleware(['auth:sanctum'])->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);
});

Route::middleware(['auth:sanctum'])->prefix('subcategories')->group(function () {
    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('show/{id}', [SubcategoryController::class, 'show']);
});

Route::middleware(['auth:sanctum'])->prefix('attributes')->group(function () {
    Route::get('/', [AttributeController::class, 'index']);
    Route::get('show/{id}', [AttributeController::class, 'show']);
    Route::get('values/{id}', [AttributeController::class, 'showValues']);
    Route::get('show/subcategory/{id}', [AttributeController::class, 'showValuesBySubcategory']);
});

// Rotas premium para interações
Route::middleware(['auth:sanctum', 'premium'])->group(function () {
    Route::post('/reviews', [ProductReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ProductReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ProductReviewController::class, 'destroy']);
    Route::post('/reviews/{review}/like', [ReviewLikeController::class, 'toggle']);
    Route::post('/reviews/{review}/replies', [ReviewReplyController::class, 'store']);
    Route::post('/replies/{reply}/like', [ReplyLikeController::class, 'toggle']);
});

// Rota de like com ofuscação
Route::middleware(['auth:sanctum', 'premium-or-obfuscate'])->group(function () {
    Route::post('/products/{product}/like', [ProductLikeController::class, 'toggle']);
});

// Rotas gerais (não premium)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/upload-image', [ImageUploadController::class, 'upload']);
});

// Visualização de reviews (com ofuscação para não premium)
Route::middleware(['auth:sanctum', 'premium-or-obfuscate'])->group(function () {
    Route::get('/products/{product}/reviews', [ProductReviewController::class, 'index']);
    Route::get('/reviews/{id}', [ProductReviewController::class, 'show']);
});

Route::get('/reviews/{review}/replies', [ReviewReplyController::class, 'index']);

// Rotas de contato e verificação premium
Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/contact/premium-request', [ContactController::class, 'sendPremiumRequest']);
    Route::get('/user/premium-status', [UserController::class, 'checkPremiumStatus']);
    Route::get('/premium/check-access', [PremiumAccessController::class, 'checkAccess']);
    Route::get('/premium/obfuscated-data', [PremiumAccessController::class, 'getObfuscatedData']);

    Route::get('/user/refresh-premium', function () {
        $user = auth()->user();
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_premium' => $user->is_premium,
                'profile_image_url' => $user->profile_image_url
            ],
            'message' => 'Dados atualizados com sucesso'
        ]);
    });
});

Route::get('/products/{product}/mentionable-users', [ReviewReplyController::class, 'getMentionableUsers']);
