<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'images',
        'category',
        'is_popular'
    ];

    protected $casts = [
        'images' => 'array',
        'is_popular' => 'boolean'
    ];
}