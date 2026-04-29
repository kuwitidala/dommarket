<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',     
        'user_id',    
        'rating',    
        'image',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function updateRating()
    {
        $avg = $this->products()->avg('rating');

        $this->update([
            'rating' => $avg ? round($avg, 1) : 0
        ]);
    }
}