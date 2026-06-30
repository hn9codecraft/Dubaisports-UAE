<?php

namespace App\Helpers;
use App\Models\Product;
use App\Models\MasterOption;
use App\Models\CategoryGroup;
use App\Models\Category;
use App\Models\CMS;
use App\Models\Country;
use App\Models\State;

class Helper
{
    public static function priceRender($productId)
    {
        $product = Product::find($productId);

        $html = '<p class="text-primary fw-bold product-price d-flex align-items-center flex-wrap">';
        if($product['discount_percentage'] > 0) {
            $html .= 'AED '.number_format($product['discounted_price'],2).'<del class="text-secondary ms-1">AED '.number_format($product['price'],2).'</del>
            <small class="badge ms-1 bg-primary px-2">'.$product['discount_percentage'].'% OFF</small>';
        } else {
            $html .= 'AED '.number_format($product['price'],2);
        }
        $html .='</p>';

        return $html;
    }

    public static function getProductBrand($productId)
    {
        $masterOptionId = MasterOption::where('name', 'LIKE','%Brand%')->pluck('id', 'id');
        
        $product = Product::where('id', $productId)->with('productSpecification', function($query) use ($masterOptionId)
        {
            $query->whereIn('option_id', $masterOptionId);
        })->first();
        
        if($product['productSpecification'] && isset($product['productSpecification'][0])) {
            if(isset($product['productSpecification'][0]['optionAttribute'])) {
                return $product['productSpecification'][0]['optionAttribute']['value'];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    public static function categoryGroups()
    {
        return CategoryGroup::where('status', '1')->with('categories')->orderBy('sort', 'ASC')->get()->toArray();
    }

    public static function categories()
    {
        return Category::where('status', '1')->with('categoryGroup')->orderBy('sort', 'ASC')->inRandomOrder()->limit(10)->get()->toArray();
    }

    public static function cmsPages()
    {
        $pages = CMS::orderBy('sort', 'asc')->get()->toArray();
        
        $html = '<ul class="list-unstyled">';

        foreach ($pages as $key => $value) {
            $html .= '<li>';
            $html .= '<a href="'.$value["slug"].'">'.$value["title"].'</a>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        
        return $html;
    }

    public static function getCountry($id)
    {
        try {
            return $id ? Country::find($id) : null;
        } catch (\Throwable $e) {
            \Log::error('getCountry failed', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    public static function getState($id)
    {
        try {
            return $id ? State::find($id) : null;
        } catch (\Throwable $e) {
            \Log::error('getState failed', [
                'id' => $id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }
}