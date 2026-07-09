<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Stock;

class ProductBasicInfo extends Component
{
    public $product, $productQty = 1, $productPrice, $productDiscountPrice, $productStock = 0, $additionalPriceEnabled = '0',
    $additionalPriceList = [], $selectedPriceOptionId = 0, $brand;

    public function mount()
    {
        $creditStock = Stock::where(['product_id' => $this->product['id'], 'type' => 'Credit'])->sum('qty');
        $debitStock = Stock::where(['product_id' => $this->product['id'], 'type' => 'Debit'])->sum('qty');
        $this->productStock = $creditStock - $debitStock;
        $this->additionalPriceEnabled = $this->product['additional_price_enable'];
        $this->additionalPriceList = json_decode($this->product['price_list'], true);
        $this->brand = !empty($this->product['brand_id']) ? \App\Models\Brand::find($this->product['brand_id']) : null;
        $this->productPrice();
    }

    public function incrementQty()
    {
        if($this->productStock > $this->productQty) {
            $this->productQty += 1; 
        }
        $this->productPrice();
    }

    public function decrementQty()
    {
        if($this->productQty > 1) {
            $this->productQty -= 1;
        }
        $this->productPrice();
    }

    public function qtyChange($value) {
        if($this->productStock >= $value) {
            $this->productQty = $value; 
        } else {
            $this->productQty = $this->productStock;
        }
        $this->productPrice();
    }

    public function productPrice()
    {
        if($this->additionalPriceEnabled == '1') {
            $this->productPrice = $this->productQty * $this->additionalPriceList[$this->selectedPriceOptionId]['price'];
            $this->productDiscountPrice = $this->productQty * $this->additionalPriceList[$this->selectedPriceOptionId]['discounted_price'];
        } else {
            $this->productPrice = $this->productQty * $this->product['price'];
            $this->productDiscountPrice = $this->productQty * $this->product['discounted_price'];
        }
        // $this->product['discounted_price'] = $this->productQty * $this->product['discounted_price'];
        // if($this->product['discount_percentage'] > 0) {
        //     $this->product['discount_percentage'] = $this->productQty * $this->product['discount_percentage'];
        // }
    }

    public function selectOption($key) {
        $this->selectedPriceOptionId = $key;
        $this->productPrice();
    }

    public function addToCart()
    {
        $product = Product::select('id', 'title', 'slug','category_id', 'main_image', 'price', 'discounted_price', 'discount_percentage', 'image_prefix_folder', 'best_seller', 'popular_product', 'additional_price_enable', 'price_list')->find($this->product['id'])->toArray();
        
        if(!\Auth::user()) {
            $cart = \Session::get('cart');
            
            $cart[$this->product['id']] = [
                'product' => $product,
                'price' => $this->productPrice,
                'productDiscountPrice' => $this->productDiscountPrice,
                'selectedPriceOptionId' => $this->selectedPriceOptionId,
                'quantity' => $this->productQty,
            ];

            \Session::put('cart', $cart);
        } else {
            $cart = Cart::where('user_id', \Auth::user()->id)->first();
            if($cart) {
                $jsonDecodedProducts = json_decode($cart['products'], true);
            }

            $jsonDecodedProducts[$this->product['id']] = [
                'product' => $product,
                'price' => $this->productPrice,
                'productDiscountPrice' => $this->productDiscountPrice,
                'selectedPriceOptionId' => $this->selectedPriceOptionId,
                'quantity' => $this->productQty,
            ];

            Cart::updateOrCreate([
                'user_id' => \Auth::user()->id
            ], [
                'user_id' => \Auth::user()->id,
                'products' => json_encode($jsonDecodedProducts)
            ]);

        }
        $this->emit('addToCartEventFire');
        // $this->dispatchBrowserEvent('swal:modal', [
        //     'type' => 'success',  
        //     'message' => 'Product has been added to cart.', 
        // ]);

        $this->dispatchBrowserEvent('toastr', [
            'type' => 'success',
            'message' => 'Product has been added to cart.',
        ]);
    }

    public function render()
    {
        return view('livewire.front.product-basic-info');
    }
}
