<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'details',
        'description',
        'description_2',
        'main_image',
        'other_images',
        'price',
        'discounted_price',
        'discount_percentage',
        'status',
        'sort',
        'image_prefix_folder',
        'best_seller',
        'popular_product',
        'combo_offer',
        'clearance_sale',
        'additional_price_enable',
        'price_list',
        'brand_id'
    ];

    public function getMainImageAttribute($value) {
        return env('APP_URL').$value;
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function brand() {
        return $this->belongsTo('App\Models\Brand');
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = Str::title($value);
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value, '-');
        }
    }

    public function setSlugAttribute($value) {
        if (!empty($value)) {
            $this->attributes['slug'] = Str::slug($value, '-');
        }
    }

    protected static function boot() {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->title, '-');
            } else {
                $product->slug = Str::slug($product->slug, '-');
            }
        });
    }

    public function productSpecification() {
        return $this->hasMany('App\Models\ProductSpecification')->with(['option', 'optionAttribute']);
    }

    public function setAdditionalPriceEnableAttribute($value) {
        $this->attributes['additional_price_enable'] = $value ? '1' : '0';
        if(!$value) {
            $this->attributes['price_list'] = '';
        }
    }

    public function setStatusAttribute($value) {
        $this->attributes['status'] = $value ? '1' : '0';
    }

    public function setBestSellerAttribute($value) {
        $this->attributes['best_seller'] = $value ? '1' : '0';
    }

    public function setPopularProductAttribute($value) {
        $this->attributes['popular_product'] = $value ? '1' : '0';
    }

    public function setComboOfferAttribute($value) {
        $this->attributes['combo_offer'] = $value ? '1' : '0';
    }

    public function setClearanceSaleAttribute($value) {
        $this->attributes['clearance_sale'] = $value ? '1' : '0';
    }
}
