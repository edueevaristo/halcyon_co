<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Api\ProductsController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {


    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/products', [ProductsController::class, 'insert']);
    Route::put('/products', [ProductsController::class, 'update']);

});

Route::prefix('categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);
    Route::get('show/{id}', [CategoryController::class, 'show']);

});

Route::prefix('subcategories')->group(function () {

    Route::get('/', [SubcategoryController::class, 'index']);
    Route::get('show/{id}', [SubcategoryController::class, 'show']);

});
