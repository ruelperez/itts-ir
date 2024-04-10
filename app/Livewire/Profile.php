<?php

namespace App\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $photo, $is_admin, $fullname;

    public function render()
    {
        $this->is_admin = auth()->user()->is_admin;
        $this->photo = auth()->user()->photo;
        $this->fullname = auth()->user()->fullname;
        return view('livewire.profile');
    }
}
