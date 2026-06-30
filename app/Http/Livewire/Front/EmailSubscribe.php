<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\EmailSubscribe as EmailSubscribeModel;

class EmailSubscribe extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function subscribe()
    {
        $this->validate();
        
        EmailSubscribeModel::updateOrCreate([
            'email' => $this->email
        ],[
            'email' => $this->email
        ]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'You are successfully subscribed.', 
        ]);

        $this->email = '';
    }
    
    public function render()
    {
        return view('livewire.front.email-subscribe');
    }
}
