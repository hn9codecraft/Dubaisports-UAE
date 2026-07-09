<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'link',
        'status'
    ];

    public function getImageAttribute($value)
    {
        if (empty($value)) {
            return '';
        }
        return asset($value);
    }
}
