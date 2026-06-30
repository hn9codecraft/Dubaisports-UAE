<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use App\Casts\Json;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'state',
        'zipcode',
        'contact_number',
        'designation_id',
        'skills',
        'english_fluency',
        'work_experience',
        'availability',
        'about_self',
        'linkedin_link',
        'github_link',
    ];

    protected $casts = [
        'work_experience' => Json::class,
    ];

    protected $append = ['address'];

    public function designation() {
        return $this->belongsTo('App\Models\Designation');
    }

    public function getAddressAttribute() {
        return "{$this->street_address}, {$this->city}, {$this->state}, {$this->zipcode}";
    }

    protected static function boot()
    {
        parent::boot();
        UserDetail::saving(function ($model) {
                $model->user_id = \Auth::user()->id;
        });
    }
}
