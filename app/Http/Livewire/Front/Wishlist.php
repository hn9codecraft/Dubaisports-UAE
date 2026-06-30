<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Auth;
use App\Models\Wishlist as WishlistModel;

class Wishlist extends Component
{
    public $page, $productId;
    
    public function addToWishlist()
    {
        if(!\Auth::user()) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',  
                'message' => 'Please Login To Move To WishList', 
            ]);
        } else {
            WishlistModel::updateOrCreate([
                'user_id' => \Auth::user()->id,
                'product_id' => $this->productId
            ],[
                'user_id' => \Auth::user()->id,
                'product_id' => $this->productId
            ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Wishlist updated Successfully!', 
            ]);
        }
    }

    public function render()
    {
        return view('livewire.front.wishlist');
    }
}
