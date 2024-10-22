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

class StaffDirectory extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $stat = [], $checkBox = [], $id_user, $ids, $ng = 0, $employeeData, $search, $dtrData = [], $staffData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $fname, $mname, $lname, $mi, $suffix, $age, $phone_number, $dob, $gender_preference, $civil_status, $religion, $personal_email, $current_house, $current_street,
        $current_brgy, $current_city, $current_working_email, $same_current_permanent = false, $permanent_house, $permanent_street, $is_success = true, $full_name,
        $permanent_brgy, $permanent_city, $sss, $philhealth, $tin, $hire_date, $yot, $designation = "Agent / Sale Associate", $department = "Admin - Production", $contact_number, $address, $relationship;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        if ($this->search != ""){
            $this->staffData = \App\Models\Employee::where('fname','LIKE', '%'.$this->search.'%')
                ->orWhere('lname', 'LIKE', '%'.$this->search.'%')
                ->orWhere('mi', 'LIKE', '%'.$this->search.'%')
                ->orWhere('mname', 'LIKE', '%'.$this->search.'%')
                ->orWhere('suffix', 'LIKE', '%'.$this->search.'%')
                ->orWhere('age', 'LIKE', '%'.$this->search.'%')
                ->orWhere('phone_number', 'LIKE', '%'.$this->search.'%')
                ->orWhere('dob', 'LIKE', '%'.$this->search.'%')
                ->orWhere('gender_preference', 'LIKE', '%'.$this->search.'%')
                ->orWhere('civil_status', 'LIKE', '%'.$this->search.'%')
                ->orWhere('religion', 'LIKE', '%'.$this->search.'%')
                ->orWhere('personal_email', 'LIKE', '%'.$this->search.'%')
                ->orWhere('current_house', 'LIKE', '%'.$this->search.'%')
                ->orWhere('current_street', 'LIKE', '%'.$this->search.'%')
                ->orWhere('current_brgy', 'LIKE', '%'.$this->search.'%')
                ->orWhere('current_city', 'LIKE', '%'.$this->search.'%')
                ->orWhere('current_working_email', 'LIKE', '%'.$this->search.'%')
                ->orWhere('permanent_house', 'LIKE', '%'.$this->search.'%')
                ->orWhere('permanent_street', 'LIKE', '%'.$this->search.'%')
                ->orWhere('permanent_brgy', 'LIKE', '%'.$this->search.'%')
                ->orWhere('permanent_city', 'LIKE', '%'.$this->search.'%')
                ->orWhere('sss', 'LIKE', '%'.$this->search.'%')
                ->orWhere('philhealth', 'LIKE', '%'.$this->search.'%')
                ->orWhere('tin', 'LIKE', '%'.$this->search.'%')
                ->orWhere('hire_date', 'LIKE', '%'.$this->search.'%')
                ->orWhere('yot', 'LIKE', '%'.$this->search.'%')
                ->orWhere('designation', 'LIKE', '%'.$this->search.'%')
                ->orWhere('department', 'LIKE', '%'.$this->search.'%')
                ->orWhere('contact_number', 'LIKE', '%'.$this->search.'%')
                ->orWhere('address', 'LIKE', '%'.$this->search.'%')
                ->orWhere('relationship', 'LIKE', '%'.$this->search.'%')
                ->orWhere('branch', 'LIKE', '%'.$this->search.'%')
                ->orWhere('fullname', 'LIKE', '%'.$this->search.'%')
                ->orWhere('id_user', 'LIKE', '%'.$this->search.'%')
                ->get();
            foreach ($this->staffData as $index => $staff){
                $this->stat[$index] = $staff->status;
            }
        }
        else{
            $this->staffData = \App\Models\Employee::all();
            foreach ($this->staffData as $index => $staff){
                $this->stat[$index] = $staff->status;
            }
        }
        return view('livewire.staff-directory');
    }

    public function updateForm(){
        $this->ng = 1;
        $this->is_success = false;
    }

    public function submitForm(){
        $this->ng = 1;
        $this->is_success = false;
        try {
            $pp = \App\Models\Employee::find($this->ids);
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
    public function clickView(){
        for ($i=0; $i<count($this->checkBox); $i++){
            $this->ids = $this->checkBox[$i];
            $pp = \App\Models\Employee::find($this->ids);
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

    public function viewInfo(){

    }
    public function mount(){
        $pst = auth()->user()->position;
        if ($pst == "Super Admin"){

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

    public function status($indexNum,$id){
        $jk = \App\Models\Employee::find($id);
        $jk->status = $this->stat[$indexNum];
        $jk->save();
        if($this->stat[$indexNum] == true){
            $u = "active";
        }
        else{
            $u = "inactive";
        }

        \App\Models\Logs::create([
            'action' => "set ".ucfirst($jk->fname).' '.ucfirst($jk->lname).' to '.$u,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }

    public function boxCheck($indexNum,$id){
        $jk = \App\Models\Employee::find($id);

        if($this->stat[$indexNum] == true){
            $u = "active";
        }
        else{
            $u = "inactive";
        }

        \App\Models\Logs::create([
            'action' => "set ".ucfirst($jk->fname).' '.ucfirst($jk->lname).' to '.$u,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }

    public function updated($field)
    {
        if ($field == "registrationSwitch") {
            $this->regSwitch();
        }
        if ($field == "adminSwitch") {
            $this->admin_Switch();
        }
        if ($field == "superAdminSwitch") {
            $this->super_admin_Switch();
        }
        if ($field == "photo") {
            $filename = Str::random(40) . '.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('photos', $filename, 'public_photos');
            $user = User::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            $user = User::find($this->user_id)->comment;
            foreach ($user as $usr) {
                $jn = Comment::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->comment_heart;
            foreach ($user as $usr) {
                $jn = CommentHeart::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr;
            foreach ($user as $usr) {
                $jn = Dtr::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr_content;
            foreach ($user as $usr) {
                $jn = DtrContent::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->log;
            foreach ($user as $usr) {
                $jn = \App\Models\Logs::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->note;
            foreach ($user as $usr) {
                $jn = Note::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->time_setting;
            foreach ($user as $usr) {
                $jn = TimeSetting::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = UserPassword::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            return redirect('/itts/16/staff-directory');
        }
    }
}
