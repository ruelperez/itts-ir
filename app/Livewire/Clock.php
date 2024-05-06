<?php

namespace App\Livewire;

use Livewire\Component;

class Clock extends Component
{
    public $time;

    public function render()
    {
        return view('livewire.clock');
    }

    public function mount(){
        $this->updateTime();
    }

    public function updateTime(){
        $this->time = now()->toTimeString();
    }
}
