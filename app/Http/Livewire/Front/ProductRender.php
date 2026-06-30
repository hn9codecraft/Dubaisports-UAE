<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\MasterOptionAttribute;

class ProductRender extends Component
{
    public $categoryId, $products = [], $keyword = '', $optionAttributeIds = [], $optionAttributes = [];

    protected $listeners = ['filterProducts'];

    public function mount()
    {
        $this->searchProducts();
    }

    public function searchProducts()
    {
        $this->products = Product::where('title', 'LIKE','%'.$this->keyword.'%')->where('status', '1')->where('category_id', $this->categoryId)->with(['category'])->get()->toArray();
    }

    public function filterProducts($value)
    {
        $optionIds = $value[1];
        $tempAttributes = [];
        foreach ($optionIds as $key => $optionIdAttributes) {
            $tempAttributes[] = $optionIdAttributes;
        }
        $tempAttributes = array_unique(call_user_func_array('array_merge', $tempAttributes));
        $this->optionAttributeIds = $tempAttributes;
        
        $this->optionAttributes = MasterOptionAttribute::whereIn('id', $this->optionAttributeIds)->get()->toArray();
        
        if(!empty($tempAttributes)) {
            $this->products = Product::where('status', '1')->whereBetween('discounted_price', [floatval($value[2]), floatval($value[3])])->whereIn('category_id', $value[0])->with(['category', 'productSpecification'])->whereHas('productSpecification', function($query) use ($tempAttributes)
            {
                $query->whereIn('option_attribute_id', $tempAttributes);
            })->get()->toArray();
        } else {
            $this->products = Product::where('status', '1')->whereBetween('discounted_price', [floatval($value[2]), floatval($value[3])])->whereIn('category_id', $value[0])->with(['category', 'productSpecification'])->get()->toArray();
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
            $this->products = Product::where('status', '1')->where('category_id', $this->categoryId)->with(['category', 'productSpecification'])->whereHas('productSpecification', function($query) use ($tempAttributes)
            {
                $query->whereIn('option_attribute_id', $tempAttributes);
            })->get()->toArray();

            $this->emit('removeFilters', $id);
            
        } else {
            $this->clearFilters();
        }

    }

    public function clearFilters()
    {
        $this->emit('removeFilters');

        $this->optionAttributeIds = [];
        $this->optionAttributes = [];
        $this->searchProducts();

    }

    public function updated()
    {
        $this->searchProducts();
    }

    public function render()
    {
        return view('livewire.front.product-render');
    }
}
