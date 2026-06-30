<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class WorkExperience extends Component
{
    public $workExperiences = [];
    
    public function mount()
    {
        $this->workExperiences[] = [
            'role' => '',
            'project_link' => '',
            'responsibilities' => ''
        ]; 
    }

    public function addMore()
    {
        $this->workExperiences[] = [
            'role' => '',
            'project_link' => '',
            'responsibilities' => ''
        ]; 
    }

    public function remove($key)
    {
        $this->workExperiences = array_splice($this->workExperiences, $key, 1);
    }
    
    public function render()
    {
        return view('livewire.front.work-experience');
    }
}
