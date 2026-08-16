<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Stock;

class StockLivewire extends Component
{
    public $products = [], $productId, $type, $qty = 0, $histories = [], $totalQty = 0;

    public function mount()
    {
        $productsData = Product::select('id', 'title', 'additional_price_enable', 'price_list')->get();
        $this->products = [];
        foreach($productsData as $product) {
            if($product->additional_price_enable == '1' && !empty($product->price_list)) {
                $priceList = json_decode($product->price_list, true);
                if (is_array($priceList)) {
                    foreach($priceList as $priceOption) {
                        $slug = isset($priceOption['slug']) && $priceOption['slug'] != '' ? $priceOption['slug'] : \Illuminate\Support\Str::slug($priceOption['title'] ?? '', '-');
                        $this->products[$product->id . '|' . $slug] = $product->title . ' (' . $priceOption['title'] . ')';
                    }
                }
            } else {
                $this->products[$product->id . '|'] = $product->title;
            }
        }
    }

    public function getReport() {
        if (!$this->productId) {
            $this->histories = [];
            $this->totalQty = 0;
            return;
        }

        $parts = explode('|', $this->productId);
        $pId = $parts[0];
        $vSlug = (isset($parts[1]) && $parts[1] !== '') ? $parts[1] : null;

        $query = Stock::where('product_id', $pId);
        if ($vSlug) {
            $query->where('variant_slug', $vSlug);
        } else {
            $query->whereNull('variant_slug');
        }

        $this->histories = (clone $query)->orderBy('id', 'desc')->with('product')->get()->toArray();
        $creditStock = (clone $query)->where('type', 'Credit')->sum('qty');
        $debitStock = (clone $query)->where('type', 'Debit')->sum('qty');
        $this->totalQty = $creditStock - $debitStock;
    }

    public function submit() {
        if (!$this->productId || !$this->type || $this->qty <= 0) {
            return;
        }
        $parts = explode('|', $this->productId);
        $pId = $parts[0];
        $vSlug = (isset($parts[1]) && $parts[1] !== '') ? $parts[1] : null;

        Stock::create([
            'product_id' => $pId,
            'variant_slug' => $vSlug,
            'type' => $this->type,
            'qty' => $this->qty
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Stock has been updated successfully.', 
        ]);

        $this->getReport();

        $this->type = '';
        $this->qty = 0;
    }

    public function clearStockHistory() {
        if (!$this->productId) return;
        
        $parts = explode('|', $this->productId);
        $pId = $parts[0];
        $vSlug = (isset($parts[1]) && $parts[1] !== '') ? $parts[1] : null;

        $query = Stock::where('product_id', $pId);
        if ($vSlug) {
            $query->where('variant_slug', $vSlug);
        } else {
            $query->whereNull('variant_slug');
        }
        $query->delete();
        
        $this->histories = [];
        $this->totalQty = 0;

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Stock has been cleared.', 
        ]);
    }

    public function render()
    {
        return view('livewire.stock-livewire');
    }
}
