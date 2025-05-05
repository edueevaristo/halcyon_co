<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {

            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return response()->json($category, 200);
    }
}
