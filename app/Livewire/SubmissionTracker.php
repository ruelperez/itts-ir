<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Announcement;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtvTracker;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\Submission;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Queue\Failed\DynamoDbFailedJobProvider;
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

    public $registrationSwitch, $hostingTrans, $gm = 0, $DQ, $jn, $toChecked = false, $comment, $caseType = "self", $is_success = false, $showSearch = false, $showSearchCoach = false, $results = [], $resultsCoach = [], $clientList = [], $campaignList = [], $campaign = "selectCampaign", $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
            $date, $cplCheck = false, $displayComment = false, $orderNumber, $subject = "Direct TV", $desciption, $service, $package, $dateSales, $submission = [], $checkboxDQ, $lawfirm = "selectLawfirm", $bam, $bbb, $client = "selectClient", $bms, $dtvRemarks, $remarks = [], $claimant, $checkboxTO = [], $lawfirmList = [], $injuredParty, $phoneNumber, $turnover, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source = "", $resultsVerifier = [], $showSearchVerifier = false ;

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
        $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
        return view('livewire.submission-tracker');
    }

    public function clickBox(){
        $num = 0;
        if (count($this->remarks) > 0){
            $sub = ['DQ','For Callback','Callback','Not Interested/Declined','Docs Needed','Need Retransfer'];

            foreach ($this->remarks as $name) {
                if (in_array($name, $sub)) {
                    $num++;

                }
            }
            if ($num > 0){
                $this->displayComment = true;
            }
            else{
                $this->displayComment = false;
            }
        }
        else{
            $this->displayComment = false;
        }
    }

    public function submitDTV(){
        $this->validate([
            'phoneNumber' => ['required', 'regex:/^[0-9]+$/'],
            'altPhoneNumber' => ['required', 'regex:/^[0-9]+$/'],
            'orderNumber' => ['required', 'regex:/^[0-9]+$/'],
        ]);
        try {
            DtvTracker::create([
                'name' => $this->claimant,
                'phone_num' => $this->phoneNumber,
                'alt_num' => $this->altPhoneNumber,
                'email' => $this->email,
                'address' => $this->address,
                'service' => $this->service,
                'package' => $this->package,
                'disposition' => $this->dtvRemarks,
                'agent' => $this->agent,
                'coach' => $this->coach,
                'description' => $this->desciption,
                'orderNumber' => $this->orderNumber,
            ]);
            $this->clearInput();
            $this->displayComment = false;
            $this->bbb = null;
            $this->bam = null;
            $this->is_success = true;
            $this->dispatch('subSubmitted');
        }catch (\Exception $e){
            $this->is_success = false;
            $this->dispatch('subSubmitted');
        }
    }

    public function submit(){
        if ($this->gm == 0){
            session()->flash('badAgent', "Successfully saved");
            return;
        }
        if ($this->caseType == "self"){
            $this->validate([
                'phoneNumber' => 'required|numeric',
                'altPhoneNumber' => 'required|numeric',
                'ssn' => 'required|numeric',
                'campaign' => 'required',
                'date' => 'required',
                'agent' => 'required',
                'claimant' => 'required',
                'coach' => 'required',
                'client' => 'required',
                'caseType' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'address' => 'required',
                'verifier' => 'required',
                'source' => 'required',
                'lawfirm' => 'required',
            ]);
        }else{
            $this->validate([
                'phoneNumber' => 'required|numeric',
                'altPhoneNumber' => 'required|numeric',
                'ssn' => 'required|numeric',
                'campaign' => 'required',
                'date' => 'required',
                'agent' => 'required',
                'claimant' => 'required',
                'injuredParty' => 'required',
                'coach' => 'required',
                'client' => 'required',
                'caseType' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'address' => 'required',
                'verifier' => 'required',
                'source' => 'required',
                'lawfirm' => 'required',
            ]);
        }
        if ($this->toChecked == true){
           $res = "(TO) - ".$this->turnover;
        }
        elseif ($this->cplCheck == true){
            $res = implode(', ', $this->submission);
        }
        else{
            $jk = implode(', ', $this->remarks);
            if ($this->comment != null or $this->comment != ""){
                $res = $jk.' - '.$this->comment;
            }
            else{
                $res = $jk;
            }

        }
        if ($this->campaign == "selectCampaign"){
            $this->campaign = "n/a";
        }
        if ($this->client == "selectClient"){
            $this->client = "n/a";
        }
        if ($this->lawfirm == "selectLawfirm"){
            $this->lawfirm = "n/a";
        }
        try {
            Submission::create([
                'date' => $this->date,
                'agent' => $this->agent,
                'claimant' => $this->claimant,
                'phoneNumber' => $this->phoneNumber,
                'altPhoneNumber' => $this->altPhoneNumber,
                'campaign' => $this->campaign,
                'coach' => $this->coach,
                'remarks' => $res,
                'client' => $this->client,
                'caseType' => $this->caseType,
                'injuredParty' => $this->injuredParty,
                'dob' => $this->dob,
                'email' => $this->email,
                'address' => $this->address,
                'ssn' => $this->ssn,
                'verifier' => $this->verifier,
                'source' => $this->source,
                'user_name' => $this->fullname,
                'user_id' => $this->user_id,
                'lawfirm' => $this->lawfirm,
            ]);
            \App\Models\Logs::create([
                'action' => "Add submission with a customer phone number ".$this->phoneNumber,
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->clearInput();
            $this->displayComment = false;
            $this->bbb = null;
            $this->bam = null;
            $this->is_success = true;
            $this->dispatch('subSubmitted');
        }catch (\Exception $e){
            $this->is_success = false;
            $this->dispatch('subSubmitted');
        }
    }

    public function clearInput(){
        $this->date = "";
        $this->caseType = "self";
        $this->claimant = "";
        $this->injuredParty = "";
        $this->phoneNumber = "";
        $this->altPhoneNumber = "";
        $this->dob = "";
        $this->email = "";
        $this->address = "";
        $this->ssn = "";
        $this->agent = "";
        $this->coach = "";
        $this->verifier = "";
        $this->source = "Dialer";
        $this->remarks = [];
        $this->toChecked = false;
        $this->checkboxTO = [];
        $this->turnover = "";
        $this->lawfirm = "";
        $this->service = "";
        $this->package = "";
        $this->dtvRemarks = "";
        $this->desciption = "";
        $this->orderNumber = "";
    }
    public function clear(){
        $this->clearInput();
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
        $this->gm = 1;
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
        $pst = auth()->user()->position;
        if ($pst != "Agent"){

        }
        else{
            return redirect('/');
        }
        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
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

    public function clickTO(){
       if ($this->toChecked == false){
           $this->toChecked = true;
           $this->remarks = [];
       }
       else{
           $this->toChecked = false;
       }

    }
    public function clickCplTrans(){
        if ($this->cplCheck == false){
            $this->cplCheck = true;
            $this->remarks = [];
        }
        else{
            $this->cplCheck = false;
        }

    }

    public function updated($field){
        if ($field == "Subject"){
            $this->clearInput();
            $this->displayComment = false;
            $this->bbb = null;
            $this->bam = null;
        }
        if ($field == "dtvRemarks"){
            $this->desciption = "";
        }
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
            $this->gm = 0;
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
            if ($this->campaign == "selectCampaign" or $this->campaign == "na"){
                $this->campaignList = Note::select('campaign')
                    ->distinct('campaign')
                    ->get();
                $this->client = "selectClient";
                $this->lawfirm = "selectLawfirm";
            }
            else{
                if ($this->campaign == "Direct TV"){
                    $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
                    $this->campaignList = Note::select('campaign')
                        ->distinct('campaign')
                        ->get();
                    $this->client = "Freddy";
                    $this->lawfirm = "selectLawfirm";
                }
                else{
                    $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
                    $this->campaignList = Note::select('campaign')
                        ->distinct('campaign')
                        ->get();
                    $this->client = "selectClient";
                    $this->lawfirm = "selectLawfirm";
                }
            }
            $this->bbb = null;
            $this->bms = [];
        }
        if ($field == "client"){
            if ($this->client == "selectClient" or $this->client == "na"){
                $this->campaignList = Note::select('campaign')
                    ->distinct('campaign')
                    ->get();
                $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
                $this->lawfirm = "selectLawfirm";
            }
            else{
                $this->lawfirmList = DB::table('notes')->select('lawfirm')->where('campaign',$this->campaign)
                    ->where('client',$this->client)->distinct()->get();
                $this->campaignList = Note::select('campaign')
                    ->distinct('campaign')
                    ->get();
                $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
                $this->lawfirm = "selectLawfirm";
            }
            $this->bbb = null;
            $this->bms = [];
        }
        if ($field == "lawfirm"){
            $this->campaignList = Note::select('campaign')
                ->distinct('campaign')
                ->get();
            $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
            $this->lawfirmList = DB::table('notes')->select('lawfirm')->where('campaign',$this->campaign)
                ->where('client',$this->client)->distinct()->get();
            $this->bms = Note::where('campaign',$this->campaign)
                ->where('client',$this->client)
                ->where('lawfirm',$this->lawfirm)->get();
            $num = 0;
            $ary = [];
            if(count($this->bms) == 0){
                $this->bbb = null;
                $this->bms = [];
            }
            elseif (count($this->bms) > 1){
                foreach ($this->bms as $bm){
                    $ary[] = $bm->method;
                }
                if ($ary[0] == $ary[1]){
                    $this->bam = 0;
                }
                else{
                    $this->bam = 1;
                }
            }else{
                $this->bam = 0;
            }
            if ($this->bam == 0){
                foreach ($this->bms as $hm){
                   $this->bbb = Note::find($hm->id);
                }

            }
            $this->remarks = [];
            $this->comment = "";
            $this->cplCheck = false;
            $this->submission = [];
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
