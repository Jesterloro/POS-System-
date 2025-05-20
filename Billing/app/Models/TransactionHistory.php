<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_id',
        'date',
        'sales_data',
        'total_amount',
        'tax',
        'discount',
        'payment_received',
        'cashier_name',  // Add cashier_name to the fillable attributes
    ];


    // Cast the sales_data field to an array for easy JSON handling
    protected $casts = [
        'sales_data' => 'array',
    ];

    // Transaction Model (Transaction.php)

public function cashier()
{
    return $this->belongsTo(User::class, 'cashier_id');
}

}
