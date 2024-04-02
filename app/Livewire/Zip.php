<?php

namespace App\Livewire;

use App\Models\IsRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Zip extends Component
{
    public $registrationSwitch, $is_admin, $fullname, $user_id, $photo, $searchInput, $request_data=[];

    public function render()
    {
        if ($this->searchInput != ""){
            $this->search();
        }
        else{
            $this->request_data = \App\Models\Zip::all();
        }
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        return view('livewire.zip');
    }

    public function search(){
        $this->request_data = DB::table('zips')
            ->where('zip_code','LIKE', '%'.$this->searchInput.'%')
            ->get();
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
    }
}
