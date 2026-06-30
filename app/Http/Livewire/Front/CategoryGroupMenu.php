<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\CategoryGroup;

class CategoryGroupMenu extends Component
{
    public $categoryGroups = [];
    
    public function mount()
    {
        $this->categoryGroups = CategoryGroup::where('status', '1')->with('categories')->orderBy('sort', 'ASC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.front.category-group-menu');
    }
}
