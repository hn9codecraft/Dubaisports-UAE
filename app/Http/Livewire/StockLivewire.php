<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Stock;

class StockLivewire extends Component
{
    public $products, $productId, $type, $qty = 0, $histories = [], $totalQty = 0;

    public function mount()
    {
        $this->products = Product::pluck('title', 'id')->toArray();
    }

    public function getReport() {
        $this->histories = Stock::where('product_id', $this->productId)->orderBy('id', 'desc')->with('product')->get()->toArray();
        $creditStock = Stock::where(['product_id' => $this->productId, 'type' => 'Credit'])->sum('qty');
        $debitStock = Stock::where(['product_id' => $this->productId, 'type' => 'Debit'])->sum('qty');
        $this->totalQty = $creditStock - $debitStock;
    }

    public function submit() {
        Stock::create([
            'product_id' => $this->productId,
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
        Stock::where('product_id', $this->productId)->delete();
        $this->histories = [];
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
