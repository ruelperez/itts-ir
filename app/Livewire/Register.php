<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\IsRegistration;
use App\Models\SuperadminShow;
use App\Models\User;
use App\Models\UserPassword;
use Livewire\Component;

class Register extends Component
{
    public $fullname, $position = "Agent", $username, $eye = 0, $eyes = 0, $admin_show, $super_admin_show, $password, $is_admin = false, $password_confirmation, $is_reg, $photo = "default_profile.png";
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

        $data = AdminShow::all();
        if (count($data) < 1){
            $this->admin_show = 1;
        }
        else{
            foreach ($data as $datas){
                $this->admin_show = $datas->on_off;
            }
        }

        $dats = SuperadminShow::all();
        if (count($dats) < 1){
            $this->super_admin_show = 1;
        }
        else{
            foreach ($dats as $datas){
                $this->super_admin_show = $datas->on_off;
            }
        }
        return view('livewire.register');
    }

    public function clickEyes($num){
        $this->eye = $num;
    }

    public function clickEyess($num){
        $this->eyes = $num;
    }

    public function submit_register(){
        $validated = $this->validate([
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            'position' => 'required',
            'photo' => 'required'
        ]);

        UserPassword::create($validated);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        auth()->login($user);
        return redirect('/');
    }
}
