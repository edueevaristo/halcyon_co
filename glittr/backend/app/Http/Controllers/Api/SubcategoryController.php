<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
        return response()->json($subcategories, 200);
    }

    public function show($id)
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {

            return response()->json(['message' => 'Subcategoria não encontrada.'], 404);
        }

        return response()->json($subcategory, 200);
    }
}
