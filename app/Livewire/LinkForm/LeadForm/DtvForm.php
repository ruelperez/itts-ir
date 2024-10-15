<?php

namespace App\Livewire\LinkForm\LeadForm;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtvTracker;
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
use Livewire\Component;

class DtvForm extends Component
{
    public $registrationSwitch, $hostingTrans, $gm = 0, $DQ, $jn, $toChecked = false, $comment, $caseType = "self", $is_success = false, $showSearch = false, $showSearchCoach = false, $results = [], $resultsCoach = [], $clientList = [], $campaignList = [], $campaign = "selectCampaign", $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $date, $cplCheck = false, $campaignName, $displayComment = false, $orderNumber, $desciption, $service, $package, $dateSales, $submission = [], $checkboxDQ, $lawfirm = "selectLawfirm", $bam, $bbb, $client = "selectClient", $bms, $dtvRemarks, $remarks = [], $claimant, $checkboxTO = [], $lawfirmList = [], $injuredParty, $phoneNumber, $turnover, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source = "", $resultsVerifier = [], $showSearchVerifier = false ;

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
        return view('livewire.link-form.lead-form.dtv-form');
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
        if ($this->gm == 0){
            session()->flash('badAgent', "Successfully saved");
            return;
        }
        $this->validate([
            'phoneNumber' => ['required', 'regex:/^[0-9]+$/'],
            'altPhoneNumber' => ['required', 'regex:/^[0-9]+$/'],
            'orderNumber' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
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
                'date' => $this->date,
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
        $this->date = "";
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

    public function mount($page){
        $this->campaignName = explode('-', $page)[0];
        $usrId = auth()->user()->id;
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
    }
}
