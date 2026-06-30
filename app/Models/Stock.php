<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'type',
        'note'
    ];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
