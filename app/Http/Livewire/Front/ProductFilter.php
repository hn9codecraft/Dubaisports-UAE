<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\MasterOptionAttribute;
use App\Models\MasterOption;
use Illuminate\Support\Str;

class ProductFilter extends Component
{
    public $categoryId, $categoryGroupId, $categories = [], $selectedCategories = [], $masterOptions = [], $selectedOptions = [],
    $products = [], $keyword = '', $optionAttributeIds = [], $optionAttributes = [], $minPrice, $maxPrice;

    public function mount() {
        if(empty($this->selectedCategories)) {
            $this->categories = Category::where('category_group_id', $this->categoryGroupId)->get()->toArray();
            $this->selectedCategories[] = 'category-'.$this->categoryId;
        }

        $categoriesMappedOption = [];

        foreach ($this->categories as $key => $value) {
            if($value['id'] == $this->categoryId) {
                $categoriesMappedOption[] = $value['option_ids'];
            }
        }
        $arraySingle = array_unique(call_user_func_array('array_merge', $categoriesMappedOption));

        array_filter($arraySingle, function($item){
            $this->selectedOptions[$item] = [];
        });
        
        $this->masterOptions = MasterOption::whereIn('id', $arraySingle)->with('attributeValues')->get()->toArray();

        $this->renderProducts();
    }

    public function updated($field)
    {
        if($field == 'selectedCategories') {
            $categoriesMappedOption = [];
            $selectedCategories = array_filter((str_replace("category-","",$this->selectedCategories)));
            $categories = Category::where('category_group_id', $this->categoryGroupId)->whereIn('id', $selectedCategories)->get()->toArray();
            foreach ($categories as $key => $value) {
                $categoriesMappedOption[] = $value['option_ids'];
            }
            $arraySingle = array_unique(call_user_func_array('array_merge', $categoriesMappedOption));

            $this->masterOptions = MasterOption::whereIn('id', $arraySingle)->with('attributeValues')->get()->toArray();
        }
        if($field != 'minPrice' && $field != "maxPrice") {
            $this->renderProducts();
        }
    }

    public function removeSelection($id)
    {
        if(($key = array_search($id, $this->optionAttributeIds)) !== false) {
            unset($this->optionAttributeIds[$key]);
        }
        $tempAttributes = $this->optionAttributeIds;

        $this->optionAttributes = MasterOptionAttribute::whereIn('id', $this->optionAttributeIds)->get()->toArray();

        if($tempAttributes) {
            $this->products = Product::where('category_id', $this->categoryId)->with(['category', 'productSpecification'])->whereHas('productSpecification', function($query) use ($tempAttributes)
            {
                $query->whereIn('option_attribute_id', $tempAttributes);
            })->get()->toArray();
            
            $this->removeFilters($id);
        } else {
            $this->clearFilters();
        }

    }

    public function removeFilters($params = null)
    {
        if(!empty($params))
        { 
            if(($key = array_search('attribute-'.$params, $this->optionAttributeIds)) !== false) {
                unset($this->optionAttributeIds[$key]);
            }
            // foreach ($this->selectedOptions as $key => $attributes) {
            //     if(($key = array_search($params, $attributes)) !== false) {
            //         unset($attributes[$key]);
            //         $this->selectedOptions[$key] = $attributes;
            //     }
            // }
        }
        $this->renderProducts();
    }

    public function clearFilters()
    {
        $this->optionAttributeIds = [];
        $this->optionAttributes = [];
        $this->renderProducts();
    }

    public function renderProducts()
    {
        $selectedCategories = array_filter((str_replace("category-","",$this->selectedCategories)));
        
        $selectedFilters = array_filter((str_replace("attribute-","",$this->optionAttributeIds)));

        $this->optionAttributes = MasterOptionAttribute::whereIn('id', $selectedFilters)->get()->toArray();

        $minPrice = $this->minPrice;
        $maxPrice = $this->maxPrice;
        
        $this->products = Product::where('status', '1')->when($selectedCategories, function($query) use ($selectedCategories, $selectedFilters){
            return $query->whereIn('category_id', $selectedCategories);
        })
        ->when($selectedFilters, function($query) use ($selectedFilters){
            return $query->with(['category', 'productSpecification'])->whereHas('productSpecification', function($query) use ($selectedFilters)
            {
                $query->whereIn('option_attribute_id', $selectedFilters);
            });
        })
        ->when($minPrice, function($query) use ($minPrice, $maxPrice){
            return $query->whereBetween('discounted_price', [floatval($minPrice), floatval($maxPrice)]);
        })
        ->get()->toArray();
    }

    public function render()
    {
        return view('livewire.front.product-filter');
    }
}
