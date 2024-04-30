<?php

namespace App\Livewire;

use App\Models\Dtr;
use Livewire\Component;

class Profile extends Component
{
    public $photo, $is_admin, $fullname, $dtrData = [];

    public function render()
    {
        $this->is_admin = auth()->user()->is_admin;
        $this->photo = auth()->user()->photo;
        $this->fullname = auth()->user()->fullname;
        $this->dtrData = Dtr::all();
        return view('livewire.profile');
    }
}
