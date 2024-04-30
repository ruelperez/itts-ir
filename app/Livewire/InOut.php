<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Dtr;
use App\Models\DtrPermanent;
use App\Models\IsRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InOut extends Component
{
    public $registrationSwitch, $designated_id, $dtr_data = [], $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        $this->photo = auth()->user()->photo;
        $this->dtr_data = Dtr::where('user_id', $this->user_id)->latest()->first();
        return view('livewire.in-out');
    }

    public function in(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            if ($this->dtr_data != null){
                $gf = Dtr::find($this->dtr_data->id);
            }
            else{
                Dtr::create([
                    'fullname' => $this->fullname,
                    'in' => now(),
                    'user_id' => $this->user_id,
                ]);

                $ss = Dtr::where('fullname',$this->fullname)
                    ->where('user_id', $this->user_id)->get();
                foreach ($ss as $s){
                    $id = $s->id;
                }

                DtrPermanent::create([
                    'fullname' => $this->fullname,
                    'in' => now(),
                    'user_id' => $this->user_id,
                    'dtr_id' => $id,
                ]);
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time in');
        }
        else{
            session()->flash('bad', 'Wrong user number!!. Please retry');
        }

    }

    public function out(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            $gf = Dtr::find($this->dtr_data->id);
            $gf->out = now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->out = now();
                $gg->save();
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time out');
        }
        else{
            session()->flash('bad', 'Wrong user number!!. Please retry');
        }

    }

    public function in2(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            $gf = Dtr::find($this->dtr_data->id);
            $gf->in2 = now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->in2 = now();
                $gg->save();
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time in');
        }
        else{
            session()->flash('bad', 'Wrong user number!!. Please retry');
        }
    }

    public function out2(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            $gf = Dtr::find($this->dtr_data->id);
            $gf->out2 = now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->out2 = now();
                $gg->save();
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time out');
        }
        else{
            session()->flash('bad', 'Wrong user number!!. Please retry');
        }
    }
    public function mount($name){
        $this->webName = $name;
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


        $data = AdminShow::all();
        if (count($data) == 0){
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = AdminShow::all();
        foreach ($an as $ans){
            $this->adminSwitch = $ans->on_off;
        }
        if ($this->adminSwitch == "0"){
            $this->adminSwitch = false;
        }
        else{
            $this->adminSwitch = true;
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
        else{
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
    }

    public function admin_Switch(){
        $data = AdminShow::all();
        if (count($data) == 1){
            if ($this->adminSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
            }
        }
        else{
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
            $an = AdminShow::all();
            foreach ($an as $ans){
                $this->adminSwitch = $ans->on_off;
            }
        }
    }

    public function updated($field){
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "adminSwitch"){
            $this->admin_Switch();
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
