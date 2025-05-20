<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'product_name',
        'quantity',
        'barcode',
        'price',
        'discount',
        'original_price',
    ];
    public function category()
{
    return $this->belongsTo(Category::class);
}
public function sales()
{
    return $this->hasMany(Sales::class);
}
}
