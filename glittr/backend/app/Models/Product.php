<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductReview;

class Product extends Model
{
    protected $fillable = [
        'product_name','description', 'brand', 'category_id', 'subcategory_id',
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

            if (isset($value[0]) && is_array($value[0]) && array_key_exists('name', $value[0]) && array_key_exists('value', $value[0])) {

                return $value;
            }

            $formatted = [];

            foreach ($value as $name => $val) {

                $formatted[] = [
                    'name' => $name,
                    'value' => $val
                ];
            }

            return $formatted;
        }

        $decoded = json_decode($value, true) ?? [];

        if ($decoded && !isset($decoded[0]['name'])) {

            $formatted = [];

            foreach ($decoded as $name => $val) {

                $formatted[] = [
                    'name' => $name,
                    'value' => $val
                ];
            }

            return $formatted;
        }

        return $decoded;
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

    public function scopeWithAttribute($query, $name, $value = null)
    {
        return $query->where('attributes', 'like', '%"name":"' . $name . '"%')->when($value, function ($q) use ($value) {
                $q->where('attributes', 'like', '%"value":"' . $value . '"%');
        });
    }

    public function setAttributesAttribute($value)
    {
        if (is_array($value)) {

            $formatted = [];

            foreach ($value as $item) {

                if (isset($item['name']) && isset($item['value'])) {

                    if ($item['value'] !== '' && $item['value'] !== null) {

                        $formatted[] = [
                            'name' => $item['name'],
                            'value' => $item['value']
                        ];
                    }
                }
            }
            $this->attributes['attributes'] = json_encode($formatted);

        } else {

            $this->attributes['attributes'] = $value;
        }
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function likes()
    {
        return $this->hasMany(ProductLike::class);
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }
}
