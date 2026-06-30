<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_group_id',
        'title',
        'slug',
        'image',
        'status',
        'sort',
        'option_ids'
    ];
    
    public function getImageAttribute($value)
    {
        return env('APP_URL').$value;
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::ucfirst($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function setOptionIdsAttribute($value) {
        $this->attributes['option_ids'] = implode(',', $value);
    }

    public function getOptionIdsAttribute($value) {
        return explode(',', $value);
    }

    public function categoryGroup()
    {
        return $this->belongsTo('App\Models\CategoryGroup');
    }
}
