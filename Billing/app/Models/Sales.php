<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'total_price', 'sale_date'];

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
