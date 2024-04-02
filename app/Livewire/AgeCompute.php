<?php

namespace App\Livewire;

use App\Models\IsRegistration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgeCompute extends Component
{
    public $registrationSwitch, $fullname, $is_admin, $user_id, $photo, $birth, $death, $error=0, $stat = "dependent", $hn = 0, $start, $alive, $end, $latency = 0, $name, $diagnosis, $age_diagnosed = 0, $age_passaway = 0, $age_started = 0, $age_left = 0, $year_exposure = 0, $remarks = 0;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        return view('livewire.age-compute');
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
}
