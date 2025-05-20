<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // In App\Models\Product.php
protected $fillable = [
    'product_name',
    'category_id', // Add this line
    'price',
    // Other fields
];

public function products()
{
    return $this->hasMany(Product::class);
}
}
