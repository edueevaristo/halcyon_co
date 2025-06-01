<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\ProductReviewController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('products')->group(function () {

    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
});

Route::post('/products', [ProductsController::class, 'insert']);
Route::put('/products', [ProductsController::class, 'update']);

/* Rotas de produto sem necessidade de login */
Route::prefix('categories')->group(function () {

    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
});


Route::prefix('categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);

});

Route::prefix('subcategories')->group(function () {

    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('show/{id}', [SubcategoryController::class, 'show']);

});

Route::prefix('attributes')->group(function () {

    Route::get('/', [AttributeController::class, 'index']);
    Route::get('show/{id}', [AttributeController::class, 'show']);
    Route::get('values/{id}', [AttributeController::class, 'showValues']);
    Route::get('show/subcategory/{id}', [AttributeController::class, 'showValuesBySubcategory']);

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\ProductReviewController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('products')->group(function () {

    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
});

Route::post('/products', [ProductsController::class, 'insert']);
Route::put('/products', [ProductsController::class, 'update']);

/* Rotas de produto sem necessidade de login */
Route::prefix('categories')->group(function () {

    Route::get('/', [ProductsController::class, 'index']);
    Route::get('show/{id}', [ProductsController::class, 'show']);
});


Route::prefix('categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);

});

Route::prefix('subcategories')->group(function () {

    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('show/{id}', [SubcategoryController::class, 'show']);

});

Route::prefix('attributes')->group(function () {

    Route::get('/', [AttributeController::class, 'index']);
    Route::get('show/{id}', [AttributeController::class, 'show']);
    Route::get('values/{id}', [AttributeController::class, 'showValues']);
    Route::get('show/subcategory/{id}', [AttributeController::class, 'showValuesBySubcategory']);

});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/reviews', [ProductReviewController::class, 'store']);
    Route::put('/reviews/{id}', [ProductReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ProductReviewController::class, 'destroy']);
});

Route::get('/products/{product}/reviews', [ProductReviewController::class, 'index']);
Route::get('/reviews/{id}', [ProductReviewController::class, 'show']);

