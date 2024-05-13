<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
use App\Models\IsRegistration;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InOut extends Component
{

    public $registrationSwitch, $timeSched = [], $selectedMinute2 = "00", $selectedHour2 = "7", $selectedHour = "1", $selectedMinute = "00", $selectedPeriod = "am", $selectedPeriod2 = "am", $permanent_id, $dtrData = [], $dtrAll = [], $task, $position, $superAdminSwitch, $weekNumber = "1", $dtr_permanent_data, $designated_id, $dtr_data = [], $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $this->photo = auth()->user()->photo;
        $this->dtr_data = Dtr::where('user_id', $this->user_id)->latest()->first();
        $this->dtr_permanent_data = DtrPermanent::where('user_id',$this->user_id)->get();
        $this->dtrData = Dtr::all();
        $this->dtrAll = DtrPermanent::all();
        $this->timeSched = TimeSetting::latest()->first();
        return view('livewire.in-out');
    }

    public function target(){

    }

    public function submitSched(){
        $o1 = $this->selectedHour.':'.$this->selectedMinute.' '.$this->selectedPeriod;
        $o2 = $this->selectedHour2.':'.$this->selectedMinute2.' '.$this->selectedPeriod2;
        try {
            if (isset($this->timeSched)){
                $gb = TimeSetting::find($this->timeSched->id);
                $gb->out = $o1;
                $gb->out2 = $o2;
                $gb->save();

                \App\Models\Logs::create([
                    'action' => "Update lunch out to ".$o1." and lunch in to ".$o2,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                TimeSetting::create([
                    'out' => $o1,
                    'out2' => $o2,
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

    public function submitTask(){
        $data = DtrPermanent::find($this->permanent_id);
        try {
            $data->task = $this->task;
            $data->save();
            session()->flash('goodTask', 'Successfully save');
        }catch (\Exception $e){
            session()->flash('badTask', 'Failed to save');
        }

    }

    public function clickTask($id){
        $this->permanent_id = $id;
        $data = DtrPermanent::find($id);
        $this->task = $data->task;
    }
    public function submitWeek(){
        $bas = DtrPermanent::all();
        try {
            foreach ($bas as $bax){
                DtrContent::create([
                    'fullname' => $bax->fullname,
                    'in' => $bax->in,
                    'out' => $bax->out,
                    'in2' => $bax->in2,
                    'out2' => $bax->out2,
                    'user_id' => $bax->user_id,
                    'dtr_id' => $bax->dtr_id,
                    'hour' => $bax->hour,
                    'minute' => $bax->minute,
                    'week' => $this->weekNumber,
                    'photo' => $bax->photo,
                    'task' => $bax->task,
                ]);
            }
            foreach ($bas as $bax){
                DtrPermanent::find($bax->id)->delete();
            }
            $fd = Dtr::all();
            foreach ($fd as $ff){
                Dtr::find($ff->id)->delete();
            }

            \App\Models\Logs::create([
                'action' => "Reset weekly DTR",
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            session()->flash('goodWeek', 'Successfully reset weekly DTR');
        }catch (\Exception $e){
            session()->flash('badWeek', 'Failed to reset weekly DTR');
        }

    }
    public function clickReset(){
        $fd = Dtr::all();
        foreach ($fd as $ff){
            Dtr::find($ff->id)->delete();
        }

        \App\Models\Logs::create([
            'action' => "Reset DTR button",
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);

    }

    public function in(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            if ($this->dtr_data != null){
                $gf = Dtr::find($this->dtr_data->id);
            }
            else {
                $gn = TimeSetting::all();
                if (count($gn) == 0){
                    TimeSetting::create([
                        'in' => "10:00 pm",
                        'out' => "01:00 am",
                        'in2' => "02:00 am",
                        'out2' => "07:00 am",
                        'fullname' => $this->fullname,
                        'user_id' => $this->user_id,
                        'photo' => $this->photo,
                    ]);
                }

                $gh = TimeSetting::all();
                    $gt = TimeSetting::all();
                    foreach ($gt as $gs) {
                        $end = $gs->out;
                        $end2 = $gs->out2;
                    }
                    $rt = Carbon::now();
                    $time1 = Carbon::parse($rt);
                    $time2 = Carbon::parse($end);
                    if ($time2->lessThan($time1)) {
                        $time2->addDay(); // Add a day to the end time
                    }
                    $interval = $time1->diff($time2);

                    //                    $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
                    //                    foreach ($gk as $gg){
                    //                        $gg->hour = $interval->h;
                    //                        $gg->minute = $interval->i;
                    //                        $gg->save();
                    //                    }
                    Dtr::create([
                        'fullname' => $this->fullname,
                        'in' => Carbon::now(),
                        'out' => $end,
                        'out2' => $end2,
                        'user_id' => $this->user_id,
                        'photo' => $this->photo
                    ]);
                    $ss = Dtr::where('fullname', $this->fullname)
                        ->where('user_id', $this->user_id)->get();
                    foreach ($ss as $s) {
                        $id = $s->id;
                    }

                    DtrPermanent::create([
                        'fullname' => $this->fullname,
                        'in' => Carbon::now(),
                        'out' => $end,
                        'out2' => $end2,
                        'user_id' => $this->user_id,
                        'dtr_id' => $id,
                        'hour' => $interval->h,
                        'minute' => $interval->i,
                        'photo' => $this->photo
                    ]);
            }
//                Dtr::create([
//                    'fullname' => $this->fullname,
//                    'in' => Carbon::now(),
//                    'user_id' => $this->user_id,
//                    'photo' => $this->photo
//                ]);
//                $ss = Dtr::where('fullname',$this->fullname)
//                    ->where('user_id', $this->user_id)->get();
//                foreach ($ss as $s){
//                    $id = $s->id;
//                }
//                DtrPermanent::create([
//                    'fullname' => $this->fullname,
//                    'in' => Carbon::now(),
//                    'user_id' => $this->user_id,
//                    'dtr_id' => $id,
//                    'hour' => "0",
//                    'minute' => "0",
//                    'photo' => $this->photo
//                ]);
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time in');
        }
        else{
            session()->flash('bad', 'Wrong user id!!. Please retry');
        }

    }

    public function out(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            $gf = Dtr::find($this->dtr_data->id);
            $gf->out = Carbon::now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->out = Carbon::now();
                $gg->save();
            }
            $gd = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gd as $gg){
                $rr = $gg->in;
                $ss = "";
            }
            $ss = "1:30 am";
            $time1 = Carbon::parse($rr);
            $time2 = Carbon::parse($ss);
            if ($time2->lessThan($time1)) {
                $time2->addDay(); // Add a day to the end time
            }
            $interval = $time1->diff($time2);
            $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gk as $gg){
                $gg->hour = $interval->h;
                $gg->minute = $interval->i;
                $gg->save();
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time out');
        }
        else{
            session()->flash('bad', 'Wrong user id!!. Please retry');
        }

    }

    public function in2(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){

            $gf = Dtr::find($this->dtr_data->id);
            $gf->in2 = Carbon::now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->in2 = Carbon::now();
                $gg->save();
            }

            $lk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($lk as $gg){
                $pp = $gg->in;
                $kk = $gg->out;
                $rr = $gg->in2;
                $ss = $gg->out2;
            }
            $time1 = Carbon::parse($pp);
            $time2 = Carbon::parse($kk);
            $interval1 = $time1->diff($time2);

            $time3 = Carbon::parse($rr);
            $time4 = Carbon::parse($ss);
            $interval2 = $time3->diff($time4);

            $resultHour = intval($interval1->h) + intval($interval2->h);
            $resultMinute = intval($interval1->i) + intval($interval2->i);


            $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gk as $gg){
                $gg->hour = $resultHour;
                $gg->minute = $resultMinute;
                $gg->save();
            }



            $gf = Dtr::find($this->dtr_data->id);
            $gf->in2 = Carbon::now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->in2 = Carbon::now();
                $gg->save();
            }

            $lk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($lk as $gg){
                $pp = $gg->in;
                $kk = $gg->out;
                $rr = $gg->in2;
                $ss = $gg->out2;
            }
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

            $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gk as $gg){
                $gg->hour = $resultHour;
                $gg->minute = $resultMinute;
                $gg->save();
            }

            $this->designated_id = "";
            session()->flash('good', 'Successfully Time in');
        }
        else{
            session()->flash('bad', 'Wrong user id!!. Please retry');
        }
    }

    public function out2(){
        $this->validate([
            'designated_id' => 'required'
        ]);
        if ($this->designated_id == "ITTS-00".$this->user_id){
            $gf = Dtr::find($this->dtr_data->id);
            $gf->out2 = Carbon::now();
            $gf->save();

            $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gs as $gg){
                $gg->out2 = Carbon::now();
                $gg->save();
            }

            $lk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($lk as $gg){
                $pp = $gg->in;
                $kk = $gg->out;
                $rr = $gg->in2;
                $ss = $gg->out2;
            }
            $time1 = Carbon::parse($pp);
            $time2 = Carbon::parse($kk);
            $interval1 = $time1->diff($time2);

            $time3 = Carbon::parse($rr);
            $time4 = Carbon::parse($ss);
            $interval2 = $time3->diff($time4);

            $resultHour = intval($interval1->h) + intval($interval2->h);
            $resultMinute = intval($interval1->i) + intval($interval2->i);


            $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
            foreach ($gk as $gg){
                $gg->hour = $resultHour;
                $gg->minute = $resultMinute;
                $gg->save();
            }
            $this->designated_id = "";
            session()->flash('good', 'Successfully Time out');
        }
        else{
            session()->flash('bad', 'Wrong user id!!. Please retry');
        }
    }
    public function mount($name){
        $this->webName = $name;
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
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
        if ($field == "superAdminSwitch"){
            $this->super_admin_Switch();
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
