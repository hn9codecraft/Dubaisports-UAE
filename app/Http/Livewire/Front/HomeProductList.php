<?php

namespace App\Http\Livewire\Front;
use App\Models\Product;

use Livewire\Component;

class HomeProductList extends Component
{
    public $products = [];
 
    public function mount($type)
    {
        if($type == 'new') {
            $this->products = Product::where('status','1')->orderBy('id', 'desc')->with(['category'])->take(8)->get()->toArray();
        } else {
            $this->products = Product::where($type, '1')->where('status','1')->orderBy('sort', 'asc')->with(['category'])->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.front.home-product-list');
    }
}
