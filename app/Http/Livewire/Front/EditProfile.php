<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\UserDetail;

class EditProfile extends Component
{
    public $data, $temp, $showEnglishPreferenceModal = true;

    public function mount() {
        $this->data = UserDetail::where('user_id', auth()->user()->id)->with(['designation'])->first();
        $this->temp = $this->data->toArray();
    }

    public function render()
    {
        return view('livewire.front.edit-profile');
    }

    public function submitSkill() {

    }

    public function submitEnglishPreference() {
        dd($this->temp['english_fluency']);
    }

    public function showEnglishPreference() {
        $this->showEnglishPreferenceModal = !$this->showEnglishPreferenceModal;
    }
}
