<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Разрешаем массовое заполнение этих полей
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'shop_id',
        'image',
        'rating',
        'material',
        'article',
        'description'
    ];

    // Связь с категорией
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Связь с магазином
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    protected static function booted()
    {
        static::created(function ($product) {
            $product->shop->updateRating();
        });

        static::updated(function ($product) {
            $product->shop->updateRating();
        });

        static::deleted(function ($product) {
            $product->shop->updateRating();
        });
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function updateRating()
    {
        $this->rating = $this->reviews()->avg('rating') ?? 0;
        $this->reviews_count = $this->reviews()->count();
        $this->save();
    }
}