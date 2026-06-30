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
        'reference_id',
        'amount',
        'currency',
        'status',
        'checkout_response',
    ];

    // Cast checkout_response to array automatically
    protected $casts = [
        'checkout_response' => 'array',
    ];
}
