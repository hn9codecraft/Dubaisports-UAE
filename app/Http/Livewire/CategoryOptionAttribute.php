<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\MasterOption;

class CategoryOptionAttribute extends Component
{
    public $categories = [], $categoryId, $options = [];

    public function mount()
    {
        $this->categories = Category::pluck('title', 'id')->toArray();
        
        if (old('category_id')) {
            $this->categoryId = old('category_id');
            $this->getoption($this->categoryId);
        }
        if($this->categoryId) { //--- Form Edit case
            $this->getoption($this->categoryId);
        };
    }

    public function getoption($id)
    {
        if($id) {
            $optionIds = Category::where('id', $id)->value('option_ids');
            
            $this->options = MasterOption::whereIn('id', $optionIds)->with('attributeValues')->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.category-option-attribute');
    }
}
