<?php

namespace App\Livewire\AdminAccess\UserCredential;

use App\Models\User;
use App\Models\UserPassword;
use Livewire\Component;

class KbtoolAccount extends Component
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
        return view('livewire.admin-access.user-credential.kbtool-account');
    }

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->user_credential;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
    }
}
