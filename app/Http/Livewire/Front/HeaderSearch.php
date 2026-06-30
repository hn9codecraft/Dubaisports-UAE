<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\MasterOption;
use App\Models\MasterOptionAttribute;
use App\Models\Cart;

class HeaderSearch extends Component
{
    public $keyword, $brands, $categories, $products, $cart = [];

    protected $listeners = ['addToCartEventFire'];

    public function mount()
    {
        $this->addToCartEventFire();
    }

    public function addToCartEventFire()
    {
        if(!\Auth::user()) {
            $this->cart = \Session::get('cart');
        } else {
            $cart = Cart::where('user_id', \Auth::user()->id)->first();
            if($cart) {
                $this->cart = json_decode($cart['products'], true);
            }
        }
    }

    public function updated()
    {
        if($this->keyword != '') {
            $this->categories = Category::where('title', 'like', '%'.$this->keyword.'%')->with('categoryGroup')->get()->toArray();
            $optionId = MasterOption::where('name', 'like', '%'.'brand'.'%')->value('id');
            $this->brands = MasterOptionAttribute::where('master_option_id', $optionId)->get()->toArray();
            $categoryIds = Category::where('title', 'like', '%'.$this->keyword.'%')->pluck('id', 'id')->toArray();
            $this->products = Product::where(function($query) use ($categoryIds) {
                $query->where('title', 'like', '%'.$this->keyword.'%')
                    ->orWhereIn('category_id', $categoryIds);
            })
            ->where('status', '1')
            ->with('category')
            ->take(3)
            ->get()
            ->toArray();
        } else {
            $this->products = [];
            $this->categories = [];
            $this->brands = [];
        }
    }

    public function render()
    {
        return view('livewire.front.header-search');
    }
}
