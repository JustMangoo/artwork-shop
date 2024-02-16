<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        // 'category_id', // Remove this line
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Change this method to reflect the many-to-many relationship
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}