<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgeCompute extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $dtrData = [], $employeeData, $position, $superAdminSwitch, $adminSwitch, $fullname, $is_admin, $webName, $user_id, $photo, $birth, $death, $error=0, $stat = "dependent", $hn = 0, $start, $alive, $end, $latency = 0, $name, $diagnosis, $age_diagnosed = 0, $age_passaway = 0, $age_started = 0, $age_left = 0, $year_exposure = 0, $remarks = 0;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        return view('livewire.age-compute');
    }

    public function mount($names){
        $this->webName = $names;
    }

    public function submit(){
        $this->error = 1;
        if ($this->alive == true){
            $this->validate([
                'birth' => ['integer','digits:4'],
                'start' => ['integer','digits:4'],
                'end' => ['integer','digits:4'],
                'diagnosis' => ['integer','digits:4'],
                'name' => 'required'
            ]);

        }
        else{
            $this->validate([
                'birth' => ['integer','digits:4'],
                'death' => ['integer','digits:4'],
                'start' => ['integer','digits:4'],
                'end' => ['integer','digits:4'],
                'diagnosis' => ['integer','digits:4'],
                'name' => 'required'
            ]);

        }

//       END VALIDATION
        if ($this->end < $this->start){
            session()->flash('fail_end', 'Must be greater than or equal to Start');
            $this->hn = 0;
            $this->remarks = 0;
            return;
        }
        if ($this->alive == true){
            $this->death = "Still alive";
            $this->age_passaway = "Alive";
        }
        else{
            if ($this->end > $this->death){
                session()->flash('fail_end_1', 'Must be less than or equal to Year of Death');
                $this->hn = 0;
                $this->remarks = 0;
                return;
            }
        }


        //        START VALIDATION
        if ($this->start < $this->birth){
            session()->flash('fail_start', 'Must be greater than Year of Birth');
            $this->hn = 0;
            $this->remarks = 0;
            return;
        }
        if ($this->alive == true){
            $this->death = "Still alive";
            $this->age_passaway = "Alive";
        }
        else{
            if ($this->start > $this->death){
                session()->flash('fail_start_1', 'Must be less than or equal to Year of Death');
                $this->hn = 0;
                $this->remarks = 0;
                return;
            }
        }


//       DEATH VALIDATION
        if ($this->alive == true){
            $this->death = "Still alive";
            $this->age_passaway = "Alive";
        }
        else{
            if ($this->death < $this->birth){
                session()->flash('fail_death', 'Must be greater than Year of Birth');
                $this->hn = 0;
                $this->remarks = 0;
                return;
            }
        }

//        DIAGNOSIS VALIDATION
        if ($this->diagnosis < $this->birth){
            session()->flash('fail_diag', 'Must be greater than or equal to Year of Birth');
            $this->hn = 0;
            $this->remarks = 0;
            return;
        }

        if ($this->alive == true){
            $this->death = "Still alive";
            $this->age_passaway = "Alive";
        }
        else{
            if ($this->diagnosis > $this->death){
                session()->flash('fail_diag_1', 'Must be less than or equal to Year of Death');
                $this->hn = 0;
                $this->remarks = 0;
                return;
            }
        }


        $this->error = 2;

//      AGE DIAGNOSED
        $this->age_diagnosed = $this->diagnosis - $this->birth;
//        AGE PASSAWAY
        if ($this->alive == true){
            $this->death = "Still alive";
            $this->age_passaway = "Alive";
        }
        else{
            $this->age_passaway = $this->death - $this->birth;
        }

//      AGE STARTED
        $this->age_started = $this->start - $this->birth;

//      AGE LEFT
        $this->age_left = $this->end - $this->birth;

//        YEAR EXPOSURE
        $this->year_exposure = $this->end - $this->start;


//        LATENCY
        $this->latency = $this->diagnosis - $this->start;

        if ($this->stat == "dependent"){
            if ($this->start >= 1953 and $this->start <= 1987 or $this->end >= 1953 and $this->end <=1987 ){
                if ($this->age_diagnosed >= 45 and $this->diagnosis >=1953){
                    $this->hn = 1;
                    $this->remarks = 1;
                }
                else{
                    $this->hn = 1;
                    $this->remarks = 0;
                }
            }
            else{
                $this->hn = 1;
                $this->remarks = 0;
            }

        }
        else{
            if ($this->start >= 1953 and $this->start <= 1987 or $this->end >= 1953 and $this->end <=1987){
                if ($this->age_started >= 17 and $this->diagnosis >=1953){
                    $this->hn = 1;
                    $this->remarks = 1;
                }
                else{
                    $this->hn = 1;
                    $this->remarks = 0;
                }
            }
            else{
                $this->hn = 1;
                $this->remarks = 0;
            }
        }
    }

    public function resetBtn(){
        $this->name = "";
        $this->birth = "";
        $this->death = "";
        $this->start = "";
        $this->end = "";
        $this->diagnosis = "";
        $this->alive = false;
        $this->hn = 0;
        $this->latency = 0;
        $this->age_passaway = 0;
        $this->age_started = 0;
        $this->age_left = 0;
        $this->age_diagnosed = 0;
        $this->year_exposure = 0;
        $this->stat = "dependent";
        $this->error = 0;
    }

    public function updated($value){
        if ($value == "photo"){
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
            return redirect('/itts/2/age-checker');
        }
        if ($value === "alive"){
//        ALIVE
            if ($this->alive == true){
                $this->death = "Still alive";
                $this->age_passaway = "Alive";
            }
            else{
                $this->death = "";
            }
        }

        if ($value == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($value == "adminSwitch"){
            $this->admin_Switch();
        }
        if ($value == "superAdminSwitch"){
            $this->super_admin_Switch();
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
}
