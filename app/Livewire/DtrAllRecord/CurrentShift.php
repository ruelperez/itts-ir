<?php

namespace App\Livewire\DtrAllRecord;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CurrentShift extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $branch = "all", $earl = false, $authorizer, $search, $employeeData, $unchangeTimeIn1, $unchangeTimeIn2, $timeIn1, $dtrName, $ids, $timeIn2, $timeOut1, $timeOut2, $date, $dtrData = [], $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $jj = Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        if ($this->search == ""){
//            if ($this->branch == "all"){
//                $this->dtrData = DtrPermanent::all();
//            }
//            else{
//                $this->dtrData = DtrPermanent::where('branch',$this->branch)->get();
//            }
            $this->dtrData = DtrPermanent::latest('updated_at')->get();
        }else{
//            $this->dtrData = DtrPermanent::where('fullname','LIKE', '%'.$this->search.'%')
//                ->orWhere('branch', 'LIKE', '%'.$this->search.'%')->get();
            $this->dtrData = DtrPermanent::where('fullname','LIKE', '%'.$this->search.'%')->get();
        }
        $this->date = DtrPermanent::latest()->first();
        return view('livewire.dtr-all-record.current-shift');
    }

    public function remove(){
        DtrPermanent::find($this->ids)->delete();
        Dtr::find($this->ids)->delete();
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
        $this->earl = $bn->isEarlyOut;
    }

    public function submitNotEarly(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }
        try {
            $bn = DtrPermanent::find($this->ids);
            $bn->isEarlyOut = false;
            $bn->save();
            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }
    }


    public function submitEarly(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }
        try {
            $bn = DtrPermanent::find($this->ids);
            $bn->isEarlyOut = true;
            $bn->save();
            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }
    }

    public function submitEdit(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }

        $bn = DtrPermanent::find($this->ids);
        try {
            $bn->in = $this->timeIn1;
            $bn->out = $this->timeOut1;
            $bn->in2 = $this->timeIn2;
            $bn->out2 = $this->timeOut2;
            $bn->save();
//            $lk = DtrPermanent::find($this->ids);
//            $pp = $lk->in;
//            $kk = $lk->out;
//            $rr = $lk->in2;
//            $ss = $lk->out2;
//            $name = $lk->fullname;
//
//            if ($rr != null or $rr != ""){
//                $time1 = Carbon::parse($pp);
//                $time2 = Carbon::parse($kk);
//                if ($time2->lessThan($time1)) {
//                    $time2->addDay(); // Add a day to the end time
//                }
//                $interval1 = $time1->diff($time2);
//
//                $time3 = Carbon::parse($rr);
//                $time4 = Carbon::parse($ss);
//                if ($time4->lessThan($time3)) {
//                    $time4->addDay(); // Add a day to the end time
//                }
//                $interval2 = $time3->diff($time4);
//
//                $resultHour = intval($interval1->h) + intval($interval2->h);
//                $resultMinute = intval($interval1->i) + intval($interval2->i);
//
//                $lk->hour = $resultHour;
//                $lk->minute = $resultMinute + 2;
//                $lk->save();
//                \App\Models\Logs::create([
//                    'action' => "Adjust time in (after lunch) from ".$this->unchangeTimeIn2.' to '.$rr.' for '.$name,
//                    'user_id' => $this->user_id,
//                    'photo' => $this->photo,
//                    'fullname' => $this->fullname,
//                ]);
//            }
//            else{
//                $time1 = Carbon::parse($pp);
//                $time2 = Carbon::parse($kk);
//                if ($time2->lessThan($time1)) {
//                    $time2->addDay(); // Add a day to the end time
//                }
//                $interval1 = $time1->diff($time2);
//
//                $resultHour = $interval1->h;
//                $resultMinute = $interval1->i;
//
//                $lk->hour = $resultHour;
//                $lk->minute = $resultMinute + 1;
//                $lk->save();
//
//                \App\Models\Logs::create([
//                    'action' => "Adjust time in from ".$this->unchangeTimeIn1.' to '.$pp.' for '.$name,
//                    'user_id' => $this->user_id,
//                    'photo' => $this->photo,
//                    'fullname' => $this->fullname,
//                ]);
//            }


            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }

    }

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $this->authorizer = $fe->dtr_record;
        if ($this->authorizer){

        }
        else{
            return redirect('/');
        }
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
            $filename = Str::random(40) . '.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('photos', $filename, 'public_photos');
            $user = User::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            $user = User::find($this->user_id)->comment;
            foreach ($user as $usr){
                $jn = Comment::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->comment_heart;
            foreach ($user as $usr){
                $jn = CommentHeart::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr;
            foreach ($user as $usr){
                $jn =Dtr::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr_content;
            foreach ($user as $usr){
                $jn =DtrContent::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->log;
            foreach ($user as $usr){
                $jn =\App\Models\Logs::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->note;
            foreach ($user as $usr){
                $jn = Note::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->time_setting;
            foreach ($user as $usr){
                $jn = TimeSetting::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = UserPassword::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            return redirect('/itts/current-shift');
        }
    }
}
