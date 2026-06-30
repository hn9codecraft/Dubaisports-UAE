<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class CMS extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'sort'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }
}
