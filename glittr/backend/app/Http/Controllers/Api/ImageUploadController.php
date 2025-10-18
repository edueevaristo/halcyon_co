<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        try {

            if ($request->hasFile('image')) {

                $path = $request->file('image')->store('products', 'public');
                return response()->json(['path' => $path], 200);
            }

            return response()->json(['error' => 'No image provided'], 400);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
