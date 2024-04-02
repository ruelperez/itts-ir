<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{
    public $username, $password;
    public function render()
    {
        return view('livewire.login')->title('Login');
    }
    public function submit_login(){
        $validated = $this->validate([
            "username" => 'required',
            "password" => 'required'
        ]);

        if(auth()->attempt($validated)){
            return redirect('/');
        }
        else{
            session()->flash('loginError', 'Login Failed, Wrong Username/Password');
        }
    }
}
