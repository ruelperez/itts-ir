<?php

namespace App\Livewire;

use App\Models\IsRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        $this->photo = auth()->user()->photo;
        return view('livewire.dashboard');
    }

    public function mount($name){
        $this->webName = $name;
    }

    protected $listeners = [
        'ret' => 'ter'
    ];

    public function ter(){
        dd('mama');
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function clickSettings(){
        $data = IsRegistration::all();

        if (count($data) == 0){
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = IsRegistration::all();
        foreach ($an as $ans){
            $this->registrationSwitch = $ans->on_off;
        }
        if ($this->registrationSwitch == "0"){
            $this->registrationSwitch = false;
        }
        else{
            $this->registrationSwitch = true;
        }
    }

    public function regSwitch(){
        $data = IsRegistration::all();
        if (count($data) == 1){
            if ($this->registrationSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
            }
        }
    }

    public function updated($field){
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "photo"){
            $this->photo->store(path: 'public');
            $hashPhoto = $this->photo->hashName();
            $user = User::find($this->user_id);
            $user->photo = $hashPhoto;
            $user->save();
            return redirect('/itts/5/dashboard');
        }
    }
}
