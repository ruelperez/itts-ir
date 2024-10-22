<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Announcement;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\Submission;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserAccess;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Laravel\Prompts\text;

class Dashboard extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $authorizer, $ids, $title, $hin, $announceData = [], $is_success = false, $employeeData, $dtrData = [], $announce, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $fe = User::find($this->user_id)->user_access->first();
        $this->authorizer = $fe->dashboard_crud;
        $jj = Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        $this->announceData = Announcement::orderBy('created_at', 'desc')->get();
        return view('livewire.dashboard')->title('Dashboard');
    }

    public function clickData($id){
        $this->ids = $id;
        $kj = Announcement::find($id);
        $this->announce = $kj->text;
        $this->title = $kj->title;
    }

//    public function click(){
//        $userPasswords = UserPassword::all();
//
//        foreach ($userPasswords as $userPassword) {
//            // Update the users table where the usernames match
//            User::where('username', $userPassword->username)
//                ->update(['show_pass' => $userPassword->password]);
//        }
//    }
    public function delete(){
        $this->hin = "removed";
        try {
            Announcement::find($this->ids)->delete();
            \App\Models\Logs::create([
                'action' => "Removed an announcement",
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->announce = "";
            $this->title = "";
            $this->is_success = true;
            $this->dispatch('remOrUp');
        }catch (\Exception $e){
            $this->is_success = false;
            $this->dispatch('remOrUp');
        }
    }

    public function updateText(){
        $this->hin = "update";
        $hd = Announcement::find($this->ids);
        $nm = $this->ids;
        try {
            $hd->text = $this->announce;
            $hd->title = $this->title;
            $hd->save();
            \App\Models\Logs::create([
                'action' => "Updates an announcement with an id ".$nm,
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->announce = "";
            $this->title = "";
            $this->is_success = true;
            $this->dispatch('remOrUp');
        }catch (\Exception $e){
            $this->is_success = false;
            $this->dispatch('remOrUp');
        }
    }
    public function mount(){
//        $this->webName = $name;
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function submitAdd(){
        try {
            Announcement::create([
                'text' => $this->announce,
                'user_id' => $this->user_id,
                'fullname' => $this->fullname,
                'title' => $this->title,
            ]);
            \App\Models\Logs::create([
                'action' => "disabled registration",
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->announce = "";
            $this->title = "";
            $this->is_success = true;
            $this->dispatch('subSubmitted');
        }catch (\Exception $e){
            $this->is_success = false;
            $this->dispatch('subSubmitted');
        }
    }
}
