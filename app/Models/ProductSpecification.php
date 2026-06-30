<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option_id',
        'option_attribute_id'
    ];

    public function option()
    {
        return $this->belongsTo('App\Models\MasterOption', 'option_id');
    }

    public function optionAttribute()
    {
        return $this->belongsTo('App\Models\MasterOptionAttribute', 'option_attribute_id');
    }
}
