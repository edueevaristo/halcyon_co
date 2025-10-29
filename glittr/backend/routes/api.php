<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\ProductReviewController;
use App\Http\Controllers\Api\ImageUploadController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'authorized'])->prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
    Route::get('show/category/{id}', [ProductsController::class, 'showByCategory']);
    Route::get('show/subcategory/{category}/{subcategory}', [ProductsController::class, 'showBySubcategory']);
    Route::post('/', [ProductsController::class, 'insert']);
    Route::put('/', [ProductsController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'authorized'])->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'authorized'])->prefix('subcategories')->group(function () {
    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('show/{id}', [SubcategoryController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'authorized'])->prefix('attributes')->group(function () {
    Route::get('/', [AttributeController::class, 'index']);
    Route::get('show/{id}', [AttributeController::class, 'show']);
    Route::get('values/{id}', [AttributeController::class, 'showValues']);
    Route::get('show/subcategory/{id}', [AttributeController::class, 'showValuesBySubcategory']);
});

Route::middleware(['auth:sanctum', 'authorized'])->group(function () {
    Route::post('/reviews', [ProductReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ProductReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ProductReviewController::class, 'destroy']);
    Route::post('/upload-image', [ImageUploadController::class, 'upload']);
    Route::post('/products/{product}/like', [App\Http\Controllers\Api\ProductLikeController::class, 'toggle']);
    Route::post('/reviews/{review}/like', [App\Http\Controllers\Api\ReviewLikeController::class, 'toggle']);
    Route::post('/reviews/{review}/replies', [App\Http\Controllers\Api\ReviewReplyController::class, 'store']);
    Route::post('/replies/{reply}/like', [App\Http\Controllers\Api\ReplyLikeController::class, 'toggle']);
});

Route::middleware(['auth:sanctum', 'authorized'])->group(function () {
    Route::get('/products/{product}/reviews', [ProductReviewController::class, 'index']);
    Route::get('/reviews/{id}', [ProductReviewController::class, 'show']);
});

Route::get('/reviews/{review}/replies', [App\Http\Controllers\Api\ReviewReplyController::class, 'index']);
Route::get('/products/{product}/mentionable-users', [App\Http\Controllers\Api\ReviewReplyController::class, 'getMentionableUsers']);

