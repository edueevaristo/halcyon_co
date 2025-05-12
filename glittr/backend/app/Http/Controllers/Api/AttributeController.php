<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return response()->json($attributes, 200);
    }

    public function show($id)
    {
        $attributes = Attribute::find($id);

        if (!$attributes) {

            return response()->json(['message' => 'Atributo não encontrado.'], 404);
        }

        return response()->json($attributes, 200);
    }

    public function showValues($id)
    {
        $values = AttributeValue::where('attribute_id', (int) $id)->get();

        if ($values->isEmpty()) {
            return response()->json(['message' => []], 404);
        }

        return response()->json($values, 200);
    }
}
