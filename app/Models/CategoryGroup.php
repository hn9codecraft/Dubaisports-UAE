<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class CategoryGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'status',
        'include_in_header',
        'sort'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getIconAttribute($value)
    {
        return $value != '' ? env('APP_URL').$value : '';
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category')->where('status', '1')->orderBy('sort', 'ASC');
    }
}
