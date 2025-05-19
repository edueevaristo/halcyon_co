<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'brand', 'category_id', 'subcategory_id',
        'attributes', 'price_average', 'ingredients', 'product_link', 'image_path'
    ];

    protected $casts = [
        'image_path' => 'array',
        'attributes' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function getAttributesAttribute($value)
    {
        if (is_null($value)) {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        return json_decode($value, true) ?? [];
    }

    public function getImagePathAttribute($value)
    {
        if (is_array($value)) {
            $paths = $value;
        } else {
            $paths = json_decode($value, true) ?? [];
        }

        return array_map(function ($image) {
            if (str_starts_with($image, 'http')) {
                return $image;
            }
            return Storage::url($image);
        }, $paths);
    }

    public function setImagePathAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['image_path'] = json_encode($value);
        } else {
            $this->attributes['image_path'] = $value;
        }
    }

    public function deleteOldImages()
    {
        $imagePaths = $this->getRawOriginal('image_path');
        $imagePaths = is_array($imagePaths) ? $imagePaths : (json_decode($imagePaths, true) ?? []);

        foreach ($imagePaths as $image) {
            $path = str_replace('/storage/', '', $image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
