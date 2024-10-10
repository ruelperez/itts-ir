<?php

namespace App\Livewire\AdminAccess;

use App\Models\UserPassword;
use Livewire\Component;

class UserCredential extends Component
{
    public $staffData = [], $search;

    public function render()
    {
        $this->staffData = UserPassword::all();
        if ($this->search == ""){
            $this->staffData = UserPassword::all();
        }else{
            $this->staffData = \App\Models\UserPassword::where('fullname','LIKE','%'.$this->search.'%')
                ->orWhere('password','LIKE','%'.$this->search.'%')
                ->orWhere('username','LIKE','%'.$this->search.'%')
                ->get();
        }
        return view('livewire.admin-access.user-credential');
    }
}
