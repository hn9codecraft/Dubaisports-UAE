<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductOptionPriceForm extends Component
{
    public $enableOptionPrice, $optionPriceList = [];

    public function mount() {
        if (old('price_list')) {
            $this->optionPriceList = json_decode(old('price_list'), true) ?? [];
        }
        
        // Ensure each existing item has a slug property if missing
        foreach ($this->optionPriceList as $key => $item) {
            if (!isset($item['slug']) || empty($item['slug'])) {
                $this->optionPriceList[$key]['slug'] = \Illuminate\Support\Str::slug($item['title'] ?? '', '-');
            }
        }
    }

    public function updated($field, $value) {
        if($field == 'enableOptionPrice' && $value == false) {
            $this->optionPriceList = [];
        }

        // Auto-generate slug when title is updated if slug is empty
        if (str_startsWith($field, 'optionPriceList.') && str_endsWith($field, '.title')) {
            $parts = explode('.', $field);
            $index = $parts[1] ?? null;
            if ($index !== null && isset($this->optionPriceList[$index])) {
                if (empty($this->optionPriceList[$index]['slug'])) {
                    $this->optionPriceList[$index]['slug'] = \Illuminate\Support\Str::slug($value, '-');
                }
            }
        }
    }

    public function add() {
        $this->optionPriceList[] = [
            'title' => '',
            'slug'  => '',
            'price' => 0
        ];
    }

    public function remove($params) {
        unset($this->optionPriceList[$params]);
        $this->optionPriceList = array_values($this->optionPriceList);
    }

    public function render()
    {
        return view('livewire.product-option-price-form');
    }
}
