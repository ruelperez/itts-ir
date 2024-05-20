<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Dtr;
use App\Models\DtrPermanent;
use App\Models\IsRegistration;
use App\Models\SuperadminShow;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CurrentShift extends Component
{
    public $registrationSwitch, $unchangeTimeIn1, $unchangeTimeIn2, $timeIn1, $dtrName, $ids, $timeIn2, $timeOut1, $timeOut2, $date, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $this->photo = auth()->user()->photo;
        $this->dtrData = DtrPermanent::all();
        $this->date = DtrPermanent::latest()->first();
        return view('livewire.current-shift');
    }

    public function clickTimeEdit($id){
        $this->ids =$id;
        $bn = DtrPermanent::find($id);
        $this->timeIn1 = $bn->in;
        $this->timeOut1 = $bn->out;
        $this->timeIn2 = $bn->in2;
        $this->timeOut2 = $bn->out2;
        $this->dtrName = $bn->fullname;
        $this->unchangeTimeIn1 = $bn->in;
        $this->unchangeTimeIn2 = $bn->in2;
    }

    public function submitEdit(){
        $bn = DtrPermanent::find($this->ids);
        try {
            $bn->in = $this->timeIn1;
            $bn->out = $this->timeOut1;
            $bn->in2 = $this->timeIn2;
            $bn->out2 = $this->timeOut2;
            $bn->save();

            $lk = DtrPermanent::find($this->ids);
            $pp = $lk->in;
            $kk = $lk->out;
            $rr = $lk->in2;
            $ss = $lk->out2;
            $name = $lk->fullname;

            if ($rr != null or $rr != ""){
                $time1 = Carbon::parse($pp);
                $time2 = Carbon::parse($kk);
                if ($time2->lessThan($time1)) {
                    $time2->addDay(); // Add a day to the end time
                }
                $interval1 = $time1->diff($time2);

                $time3 = Carbon::parse($rr);
                $time4 = Carbon::parse($ss);
                if ($time4->lessThan($time3)) {
                    $time4->addDay(); // Add a day to the end time
                }
                $interval2 = $time3->diff($time4);

                $resultHour = intval($interval1->h) + intval($interval2->h);
                $resultMinute = intval($interval1->i) + intval($interval2->i);

                $lk->hour = $resultHour;
                $lk->minute = $resultMinute + 2;
                $lk->save();
                \App\Models\Logs::create([
                    'action' => "Adjust time in (after lunch) from ".$this->unchangeTimeIn2.' to '.$rr.' for '.$name,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                $time1 = Carbon::parse($pp);
                $time2 = Carbon::parse($kk);
                if ($time2->lessThan($time1)) {
                    $time2->addDay(); // Add a day to the end time
                }
                $interval1 = $time1->diff($time2);

                $resultHour = $interval1->h;
                $resultMinute = $interval1->i;

                $lk->hour = $resultHour;
                $lk->minute = $resultMinute + 1;
                $lk->save();

                \App\Models\Logs::create([
                    'action' => "Adjust time in from ".$this->unchangeTimeIn1.' to '.$pp.' for '.$name,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }


            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }

    }

    public function mount(){

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

        $data = SuperadminShow::all();
        if (count($data) == 0){
            SuperadminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = SuperadminShow::all();
        foreach ($an as $ans){
            $this->superAdminSwitch = $ans->on_off;
        }
        if ($this->superAdminSwitch == "0"){
            $this->superAdminSwitch = false;
        }
        else{
            $this->superAdminSwitch = true;
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
                \App\Models\Logs::create([
                    'action' => "disabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
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
                \App\Models\Logs::create([
                    'action' => "enabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
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
                \App\Models\Logs::create([
                    'action' => "disabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
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
                \App\Models\Logs::create([
                    'action' => "enabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
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

    public function super_admin_Switch(){
        $data = SuperadminShow::all();
        if (count($data) == 1) {
            if ($this->superAdminSwitch == false) {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            } else {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
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
        if ($field == "superAdminSwitch"){
            $this->super_admin_Switch();
        }
        if ($field == "photo"){
            $this->photo->store(path: 'public');
            $hashPhoto = $this->photo->hashName();
            $user = User::find($this->user_id);
            $user->photo = $hashPhoto;
            $user->save();
//            $com = Comment::find($this->user_id);
//            if (isset($com)){
//                $com->photo = $hashPhoto;
//                $com->save();
//            }
//            $comHeart = CommentHeart::find($this->user_id);
//            if (isset($comHeart)){
//                $comHeart->photo = $hashPhoto;
//                $comHeart->save();
//            }
//            $dtr = Dtr::find($this->user_id);
//            if (isset($comHeart)){
//                $comHeart->photo = $hashPhoto;
//                $comHeart->save();
//            }
            return redirect('/itts/5/dashboard');
        }
    }
}
