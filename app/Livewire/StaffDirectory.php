<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
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
    public $registrationSwitch, $stat = [], $checkBox = [], $employeeData, $search, $dtrData = [], $staffData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

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
