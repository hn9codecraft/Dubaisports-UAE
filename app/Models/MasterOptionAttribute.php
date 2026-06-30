<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOptionAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_option_id',
        'value',
    ];
}
