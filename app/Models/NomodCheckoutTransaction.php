<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomodCheckoutTransaction extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'nomod_checkout_transactions';

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'reference_id',
        'amount',
        'currency',
        'status',
        'checkout_response',
        'checkout_details',
        'cart_products',
    ];

    // Cast JSON columns to array automatically
    protected $casts = [
        'checkout_response' => 'array',
        'checkout_details' => 'array',
        'cart_products' => 'array',
    ];
}
