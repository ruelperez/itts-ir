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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Laravel\Prompts\select;
use function Laravel\Prompts\table;

class SubmissionTracker extends Component
{
    use WithFileUploads;
    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $caseType = "self", $showSearch = false, $showSearchCoach = false, $results = [], $resultsCoach = [], $result=[], $clientList, $campaignList = [], $campaign, $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
            $date, $client, $claimant, $injuredParty, $phoneNumber, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source, $resultsVerifier = [], $showSearchVerifier = false ;

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
        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
        return view('livewire.submission-tracker');
    }

    public function submit(){
        if ($this->altPhoneNumber != "" or $this->altPhoneNumber != null){
            $this->validate([
                'altPhoneNumber' => 'numeric',
            ]);
        }
        $this->validate([
            'phoneNumber' => 'required|numeric',
            'ssn' => 'required|numeric',
        ]);
        dd(count($this->result));
        for ($i=0; $i<count($this->result); $i++){

        }

    }

    public function removeSearch(){
        $this->showSearch = false;
    }

    public function removeSearchVerifier(){
        $this->showSearchVerifier = false;
    }

    public function removeSearchCoach(){
        $this->showSearchCoach = false;
    }

    public function clickSearch(){
        if ($this->agent != ""){
            $this->results = Employee::where('fname','LIKE','%'. $this->agent. '%')
                ->orWhere('lname','LIKE','%'. $this->agent. '%')
                ->take(5)
                ->get();
            $this->showSearch = true;
        }
        else{
            $this->showSearch = false;
            $this->results = [];
        }
    }

    public function clickSearchVerifier(){
        if ($this->verifier != ""){
            $this->resultsVerifier = Employee::where('fname','LIKE','%'. $this->verifier. '%')
                ->orWhere('lname','LIKE','%'. $this->verifier. '%')
                ->take(5)
                ->get();
            $this->showSearchVerifier = true;
        }
        else{
            $this->showSearchVerifier = false;
            $this->resultsVerifier = [];
        }
    }

    public function clickSearchCoach(){
        if ($this->coach != ""){
            $this->resultsCoach = Employee::where('fname','LIKE','%'. $this->coach. '%')
                ->where('designation','Subject Matter Expert')
                ->where('designation','Team Leader')
                ->where('designation','Senior Team Leader')
                ->orWhere('lname','LIKE','%'. $this->coach. '%')
                ->where('designation','Subject Matter Expert')
                ->where('designation','Team Leader')
                ->where('designation','Senior Team Leader')->take(5)
                ->get();
            $this->showSearchCoach = true;
        }
        else{
            $this->showSearchCoach = false;
            $this->resultsCoach = [];
        }
    }

    public function click_items($id){
        $gh = Employee::find($id);
        $this->agent = $gh->fname.' '.$gh->lname;
        $this->showSearchCoach = false;
    }

    public function click_itemsVerifier($id){
        $gh = Employee::find($id);
        $this->verifier = $gh->fname.' '.$gh->lname;
        $this->showSearchVerifier = false;
    }
    public function click_itemsCoach($id){
        $gh = Employee::find($id);
        $this->coach = $gh->fname.' '.$gh->lname;
        $this->showSearchCoach = false;
    }

    public function mount(){
        $usrId = auth()->user()->id;
        $sd = \App\Models\Employee::where('user_id',$usrId)->get();
        if (count($sd) < 1){
            return redirect('/itts/15/employee');
        }
        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
            foreach ($this->campaignList as $list){
                $this->clientList = DB::table('notes')->select('client')->where('campaign',$list->campaign)->distinct()->get();
                break;
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
        if ($field == "verifier"){
            if ($this->verifier != ""){
                $this->resultsVerifier = Employee::where('fname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('fname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('fname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Senior Team Leader')
                    ->orWhere('lname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('lname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('lname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Senior Team Leader')
                    ->take(5)
                    ->get();
                $this->showSearchVerifier = true;
            }
            else{
                $this->showSearchVerifier = false;
                $this->resultsVerifier = [];
            }

        }
        if ($field == "coach"){
            if ($this->coach != ""){
                $this->resultsCoach = Employee::where('fname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('fname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('fname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Senior Team Leader')
                    ->orWhere('lname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('lname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('lname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Senior Team Leader')
                    ->take(5)
                    ->get();
                $this->showSearchCoach = true;
            }
            else{
                $this->showSearchCoach = false;
                $this->resultsCoach = [];
            }

        }
        if ($field == "agent"){
            if ($this->agent != ""){
                $this->results = Employee::where('fname','LIKE','%'. $this->agent. '%')
                    ->orWhere('lname','LIKE','%'. $this->agent. '%')->take(5)
                    ->get();
                $this->showSearch = true;
            }
            else{
                $this->showSearch = false;
                $this->results = [];
            }

        }
        if ($field == "campaign"){
            $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
        }
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
            return redirect('/itts/5/dashboard');
        }
    }
}
