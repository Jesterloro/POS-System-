<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    protected $fillable = ['name', 'email', 'password', 'company'];

    // Optional: if you want to hash passwords, use mutators
    protected $hidden = ['password'];
}
