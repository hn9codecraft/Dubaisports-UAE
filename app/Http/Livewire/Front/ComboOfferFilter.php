<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\MasterOptionAttribute;
use App\Models\MasterOption;

class ComboOfferFilter extends Component
{
    public $categories = [], $selectedCategories = [], $masterOptions = [], $selectedOptions = [],
    $products = [], $keyword = '', $optionAttributeIds = [], $optionAttributes = [], $minPrice, $maxPrice;

    public function mount() {
        // Fetch only categories that contain combo offer products
        $categoryIds = Product::where('combo_offer', '1')
            ->where('status', '1')
            ->pluck('category_id')
            ->unique()
            ->filter();

        $this->categories = Category::whereIn('id', $categoryIds)->get()->toArray();

        $categoriesMappedOption = [];
        foreach ($this->categories as $value) {
            if (!empty($value['option_ids'])) {
                $categoriesMappedOption[] = $value['option_ids'];
            }
        }

        $arraySingle = [];
        if (!empty($categoriesMappedOption)) {
            $arraySingle = array_unique(call_user_func_array('array_merge', $categoriesMappedOption));
        }

        foreach ($arraySingle as $item) {
            $this->selectedOptions[$item] = [];
        }
        
        $this->masterOptions = MasterOption::whereIn('id', $arraySingle)->with('attributeValues')->get()->toArray();

        $this->renderProducts();
    }

    public function updated($field)
    {
        if ($field == 'selectedCategories') {
            $selectedCategories = array_filter(str_replace("category-", "", $this->selectedCategories));
            if (empty($selectedCategories)) {
                $categories = $this->categories;
            } else {
                $categories = Category::whereIn('id', $selectedCategories)->get()->toArray();
            }

            $categoriesMappedOption = [];
            foreach ($categories as $value) {
                if (!empty($value['option_ids'])) {
                    $categoriesMappedOption[] = $value['option_ids'];
                }
            }

            $arraySingle = [];
            if (!empty($categoriesMappedOption)) {
                $arraySingle = array_unique(call_user_func_array('array_merge', $categoriesMappedOption));
            }

            $this->masterOptions = MasterOption::whereIn('id', $arraySingle)->with('attributeValues')->get()->toArray();
        }

        if ($field != 'minPrice' && $field != "maxPrice") {
            $this->renderProducts();
        }
    }

    public function removeSelection($id)
    {
        if (($key = array_search($id, $this->optionAttributeIds)) !== false) {
            unset($this->optionAttributeIds[$key]);
        }
        $tempAttributes = $this->optionAttributeIds;

        $this->optionAttributes = MasterOptionAttribute::whereIn('id', $this->optionAttributeIds)->get()->toArray();

        if ($tempAttributes) {
            $this->products = Product::where('combo_offer', '1')
                ->where('status', '1')
                ->with(['category', 'productSpecification'])
                ->whereHas('productSpecification', function($query) use ($tempAttributes) {
                    $query->whereIn('option_attribute_id', $tempAttributes);
                })
                ->get()->toArray();
            
            $this->removeFilters($id);
        } else {
            $this->clearFilters();
        }
    }

    public function removeFilters($params = null)
    {
        if (!empty($params)) { 
            if (($key = array_search('attribute-'.$params, $this->optionAttributeIds)) !== false) {
                unset($this->optionAttributeIds[$key]);
            }
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
        $selectedCategories = array_filter(str_replace("category-", "", $this->selectedCategories));
        $selectedFilters = array_filter(str_replace("attribute-", "", $this->optionAttributeIds));

        $this->optionAttributes = MasterOptionAttribute::whereIn('id', $selectedFilters)->get()->toArray();

        $minPrice = $this->minPrice;
        $maxPrice = $this->maxPrice;
        $keyword = $this->keyword;
        
        $this->products = Product::where('combo_offer', '1')
            ->where('status', '1')
            ->when($selectedCategories, function($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories);
            })
            ->when($selectedFilters, function($query) use ($selectedFilters) {
                return $query->with(['category', 'productSpecification'])->whereHas('productSpecification', function($query) use ($selectedFilters) {
                    $query->whereIn('option_attribute_id', $selectedFilters);
                });
            })
            ->when($minPrice, function($query) use ($minPrice, $maxPrice) {
                return $query->whereBetween('discounted_price', [floatval($minPrice), floatval($maxPrice)]);
            })
            ->when($keyword, function($query) use ($keyword) {
                return $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->get()->toArray();
    }

    public function render()
    {
        // Reuses the exact same styling/view as regular product filtering
        return view('livewire.front.product-filter');
    }
}
