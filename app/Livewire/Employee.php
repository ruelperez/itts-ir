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
            $permanent_brgy, $permanent_city, $employeeFullname, $sss, $philhealth, $tin, $hire_date, $yot, $designation = "Agent / Sale Associate", $department = "Admin - Production", $contact_number, $address, $relationship;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
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
            $this->employeeFullname = $pp->fname.' '.$pp->mi.' '.$pp->lname;
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
        $this->employeeFullname = $this->fname.' '.$this->mi.' '.$this->lname;
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
                    'employeeFullname' => $this->employeeFullname,
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
                    $pp->employeeFullname = $this->employeeFullname;
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
    }

}
