<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'sort'
    ];

    public function attributeValues()
    {
        return $this->hasMany('App\Models\MasterOptionAttribute')->orderBy('value', 'ASC');
    }
}
