<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'brand', 'category_id', 'subcategory_id',
        'type_of_coverage', 'type_of_finish', 'fps', 'available_tones',
        'oil_free', 'price_average', 'ingredients', 'product_link', 'image_path'
    ];

    protected $casts = [
        'image_path' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function getImagePathAttribute($value)
    {
        $paths = json_decode($value, true);
        if (!$paths) return [];

        return array_map(function ($image) {
            return Storage::url($image);
        }, $paths);
    }

    public function setImagePathsAttribute($value)
    {
        $this->attributes['image_path'] = $value;
    }

    public function deleteOldImages()
    {
        $imagePaths = $this->image_path ?? [];

        foreach ($imagePaths as $image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
    }
}
