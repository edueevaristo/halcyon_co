<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'brand', 'category_id', 'subcategory_id',
        'type_of_coverage', 'type_of_finish', 'fps', 'available_tones',
        'oil_free', 'price_average', 'ingredients', 'product_link', 'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}

