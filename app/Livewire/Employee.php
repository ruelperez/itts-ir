<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
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

class Employee extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $id_user, $full_name, $empData, $is_submitted = false, $branch = "bicol", $ng = 0, $is_create, $is_success = false, $employeeData, $dtrData = [], $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
            $fname, $mname, $lname, $mi, $suffix, $age, $phone_number, $dob, $gender_preference, $civil_status, $religion, $personal_email, $current_house, $current_street,
            $current_brgy, $current_city, $current_working_email, $same_current_permanent = false, $permanent_house, $permanent_street,
            $permanent_brgy, $permanent_city, $authorizer, $sss, $philhealth, $tin, $hire_date, $yot, $designation = "Agent / Sale Associate", $department = "Admin - Production", $contact_number, $address, $relationship;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $fe = User::find($this->user_id)->user_access->first();
        $this->authorizer = $fe->staff_directory;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        $gn = \App\Models\Employee::where('user_id',$this->user_id)->get();
        if ($this->ng == 0){
            if (count($gn) < 1){
                $this->is_create = true;
            }
            else{
                $this->is_create = false;
                $this->is_success = true;
                $this->getInfo();
            }
        }
        $this->empData = \App\Models\Employee::where('user_id',$this->user_id)->get();
        return view('livewire.employee')->title('Employee info');
    }

    public function  getInfo(){
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $gg) {
            $pp = \App\Models\Employee::find($gg->id);
            $this->branch = $pp->branch;
            $this->fname = $pp->fname;
            $this->lname = $pp->lname;
            $this->mi = $pp->mi;
            $this->mname = $pp->mname;
            $this->suffix = $pp->suffix;
            $this->age = $pp->age;
            $this->phone_number = $pp->phone_number;
            $this->dob = $pp->dob;
            $this->gender_preference = $pp->gender_preference;
            $this->civil_status = $pp->civil_status;
            $this->religion = $pp->religion;
            $this->personal_email = $pp->personal_email;
            $this->current_house = $pp->current_house;
            $this->current_street = $pp->current_street;
            $this->current_brgy = $pp->current_brgy;
            $this->current_city = $pp->current_city;
            $this->current_working_email = $pp->current_working_email;
            $this->permanent_house = $pp->permanent_house;
            $this->permanent_street = $pp->permanent_street;
            $this->permanent_brgy = $pp->permanent_brgy;
            $this->permanent_city = $pp->permanent_city;
            $this->sss = $pp->sss;
            $this->philhealth = $pp->philhealth;
            $this->tin = $pp->tin;
            $this->hire_date = $pp->hire_date;
            $this->yot = $pp->yot;
            $this->designation = $pp->designation;
            $this->department = $pp->department;
            $this->contact_number = $pp->contact_number;
            $this->address = $pp->address;
            $this->relationship = $pp->relationship;
            $this->full_name = $pp->fullname;
            $this->id_user = $pp->id_user;
            if ($this->department == "" or $this->department == null){
                $this->department = "Admin - Production";
                $this->designation = "Agent/ Sale Associate";
            }
        }
    }
    public function mount($name){
        $this->webName = $name;
    }

    public function submitForm()
    {
        $this->ng = 1;
        $this->is_success = false;
        try {
            if ($this->is_create == true){
                \App\Models\Employee::create([
                    'fname' => $this->fname,
                    'lname' => $this->lname,
                    'mi' => $this->mi,
                    'mname' => $this->mname,
                    'suffix' => $this->suffix,
                    'age' => $this->age,
                    'phone_number' => $this->phone_number,
                    'dob' => $this->dob,
                    'gender_preference' => $this->gender_preference,
                    'civil_status' => $this->civil_status,
                    'religion' => $this->religion,
                    'personal_email' => $this->personal_email,
                    'current_house' => $this->current_house,
                    'current_street' => $this->current_street,
                    'current_brgy'=> $this->current_brgy,
                    'current_city' => $this->current_city,
                    'current_working_email' => $this->current_working_email,
                    'permanent_house' => $this->permanent_house,
                    'permanent_street' => $this->permanent_street,
                    'permanent_brgy' => $this->permanent_brgy,
                    'permanent_city' => $this->permanent_city,
                    'sss' => $this->sss,
                    'philhealth' => $this->philhealth,
                    'tin' => $this->tin,
                    'hire_date' => $this->hire_date,
                    'yot' => $this->yot,
                    'designation'=> $this->designation,
                    'department'=> $this->department,
                    'contact_number' => $this->contact_number,
                    'address' => $this->address,
                    'relationship' => $this->relationship,
                    'user_id' => $this->user_id,
                    'branch' => $this->branch,
                    'fullname' => $this->full_name,
                    'id_user' => 'ITTS-00'.$this->user_id,
                ]);
                $ff = User::find($this->user_id);
                $ff->branch = $this->branch;
                $ff->save();


                $full = $this->fname.' '.$this->lname;

                $a = User::find($this->user_id);
                if ($a->fullname != $full){
                    $a->fullname = $full;
                    $a->save();
                }

                $b = UserPassword::find($this->user_id);
                if ($b->fullname != $full){
                    $b->fullname = $full;
                    $b->save();
                }

            }
            else{
                $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
                foreach ($jj as $gg){
                    $pp = \App\Models\Employee::find($gg->id);
                    $pp->fname = $this->fname;
                    $pp->lname = $this->lname;
                    $pp->mi = $this->mi;
                    $pp->mname = $this->mname;
                    $pp->suffix = $this->suffix;
                    $pp->age = $this->age;
                    $pp->phone_number = $this->phone_number;
                    $pp->dob = $this->dob;
                    $pp->gender_preference = $this->gender_preference;
                    $pp->civil_status = $this->civil_status;
                    $pp->religion = $this->religion;
                    $pp->personal_email = $this->personal_email;
                    $pp->current_house = $this->current_house;
                    $pp->current_street = $this->current_street;
                    $pp->current_brgy = $this->current_brgy;
                    $pp->current_city = $this->current_city;
                    $pp->current_working_email = $this->current_working_email;
                    $pp->permanent_house = $this->permanent_house;
                    $pp->permanent_street = $this->permanent_street;
                    $pp->permanent_brgy = $this->permanent_brgy;
                    $pp->permanent_city = $this->permanent_city;
                    $pp->sss = $this->sss;
                    $pp->philhealth = $this->philhealth;
                    $pp->tin = $this->tin;
                    $pp->hire_date = $this->hire_date;
                    $pp->yot = $this->yot;
                    $pp->designation = $this->designation;
                    $pp->department = $this->department;
                    $pp->branch = $this->branch;
                    $pp->contact_number = $this->contact_number;
                    $pp->address = $this->address;
                    $pp->relationship = $this->relationship;
                    $pp->fullname = $this->full_name;
                    $pp->save();
                }
                $ff = User::find($this->user_id);
                $ff->branch = $this->branch;
                $ff->save();

                $ff = User::find($this->user_id)->dtr;
                foreach ($ff as $gg){
                    $aa = Dtr::find($gg->id);
                    $aa->branch = $this->branch;
                    $aa->save();
                }

                $ff = User::find($this->user_id)->dtr_permanent;
                foreach ($ff as $gg){
                    $aa = DtrPermanent::find($gg->id);
                    $aa->branch = $this->branch;
                    $aa->save();
                }

                $ff = User::find($this->user_id)->dtr_content;
                foreach ($ff as $gg){
                    $aa = DtrContent::find($gg->id);
                    $aa->branch = $this->branch;
                    $aa->save();
                }

                $full = $this->fname.' '.$this->lname;

                $a = User::find($this->user_id);
                if ($a->fullname != $full){
                    $a->fullname = $full;
                    $a->save();
                }

                $b = UserPassword::find($this->user_id);
                if ($b->fullname != $full){
                    $b->fullname = $full;
                    $b->save();
                }
            }
            if ($this->is_create == true){
                return redirect('/');
            }
            $this->getInfo();
            $this->is_success = true;
            // Emit event to trigger modal
            $this->dispatch('formSubmitted');
        }catch (\Exception $e){
            $this->is_success = false;
        }
    }

    public function updateForm(){
        $this->ng = 1;
        $this->is_success = false;
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
        if ($field == "department"){
            if ($this->department == "Management"){
                $this->designation = "Chief Executive Officer";
            }
            elseif ($this->department == "Admin"){
                $this->designation = "Accounts and Back Office Manager";
            }
            elseif ($this->department == "Admin - Production"){
                $this->designation = "Agent / Sale Associate";

            }
            elseif ($this->department == "Admin - Back Office"){
                $this->designation = "Quality Assurance";
            }
        }
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "adminSwitch"){
            $this->admin_Switch();
        }
        if ($field == "same_current_permanent"){
            $this->ng = 1;
            if ($this->same_current_permanent == true){
                $this->permanent_house = $this->current_house;
                $this->permanent_street = $this->current_street;
                $this->permanent_brgy = $this->current_brgy;
                $this->permanent_city = $this->current_city;
            }
            else{
                $this->permanent_house = "";
                $this->permanent_street = "";
                $this->permanent_brgy = "";
                $this->permanent_city = "";
            }
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
            return redirect('/itts/15/employee');
        }
    }

}
