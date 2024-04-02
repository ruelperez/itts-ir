<?php

namespace App\Livewire;

use App\Models\IsRegistration;
use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $fullname, $username, $password, $is_admin = false, $password_confirmation, $is_reg;
    public function render()
    {
        $data = IsRegistration::all();
        if (count($data) < 1){
            $this->is_reg = 1;
        }
        else{
            foreach ($data as $datas){
                $this->is_reg = $datas->on_off;
            }
        }

        return view('livewire.register');
    }

    public function submit_register(){
        $validated = $this->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            'is_admin' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        auth()->login($user);
        return redirect('/');
    }
}
