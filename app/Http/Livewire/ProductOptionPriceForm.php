<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductOptionPriceForm extends Component
{
    public $enableOptionPrice, $optionPriceList = [];

    public function mount() {
        if (old('price_list')) {
            $this->optionPriceList[] = json_decode(old('price_list'), true);
        }
    }

    public function updated($field, $value) {
        if($field == 'enableOptionPrice' && $value == false) {
            $this->optionPriceList = [];
        }
    }

    public function add() {
        $this->optionPriceList[] = [
            'title' => '',
            'price' => 0
        ];
    }

    public function remove($params) {
        unset($this->optionPriceList[$params]);
    }

    public function render()
    {
        return view('livewire.product-option-price-form');
    }
}
