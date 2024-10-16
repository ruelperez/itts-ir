<?php

namespace App\Livewire\AdminAccess\LeadTracker;

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
use Livewire\Component;

class DtvTracker extends Component
{
    public $registrationSwitch, $returnClient, $returnReason, $currentPage = 1, $perPage = 15, $is_success = false, $search, $ids, $displayRemarks, $checkBox = [], $submissionData = [], $resultsCoach = [], $employeeData, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo, $campaignList = [], $campaign,
        $date, $base = true, $toChecked = false, $folderName, $package, $disposition, $description, $orderNumber, $service, $customer, $lawfirm, $lawfirmList = [], $dqReason, $client, $remarks = [], $claimant, $injuredParty, $phoneNumber, $altPhoneNumber, $dob, $email, $address, $ssn, $showSearch = false, $showSearchCoach = false, $agent, $coach, $verifier, $source = "Dialer", $caseType = "self", $resultsVerifier = [], $results = [], $clientList= [], $showSearchVerifier = false, $result;

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
        if ($this->search == ""){
            $this->displayData();
        }
        else{
            $this->submissionData = \App\Models\DtvTracker::where('phone_num', 'LIKE', '%'.$this->search.'%')
                ->orWhere('alt_num', 'LIKE', '%'.$this->search.'%')
                ->orWhere('date', 'LIKE', '%'.$this->search.'%')
                ->orWhere('agent', 'LIKE', '%'.$this->search.'%')
                ->orWhere('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('coach', 'LIKE', '%'.$this->search.'%')
                ->orWhere('result', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                ->orWhere('address', 'LIKE', '%'.$this->search.'%')
                ->orWhere('service', 'LIKE', '%'.$this->search.'%')
                ->orWhere('package', 'LIKE', '%'.$this->search.'%')
                ->orWhere('disposition', 'LIKE', '%'.$this->search.'%')
                ->orWhere('description', 'LIKE', '%'.$this->search.'%')
                ->orWhere('orderNumber', 'LIKE', '%'.$this->search.'%')
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.admin-access.'.$this->folderName.'.dtv-tracker');
    }

    public function clearCheck(){
        $this->checkBox = [];
    }

    public function edit(){
        for ($i=0; count($this->checkBox) > $i; $i++){
            $this->ids = $this->checkBox[$i];
            $yr = \App\Models\DtvTracker::find($this->checkBox[$i]);
            $this->date = $yr->date;
            $this->campaign = $yr->campaign;
            $this->client = $yr->client;
            $this->lawfirm = $yr->lawfirm;
            $this->caseType = $yr->caseType;
            $this->claimant = $yr->claimant;
            $this->injuredParty = $yr->injuredParty;
            $this->phoneNumber = $yr->phoneNumber;
            $this->altPhoneNumber = $yr->altPhoneNumber;
            $this->dob = $yr->dob;
            $this->email = $yr->email;
            $this->address = $yr->address;
            $this->ssn = $yr->ssn;
            $this->agent = $yr->agent;
            $this->coach = $yr->coach;
            $this->verifier = $yr->verifier;
            $this->source = $yr->source;
            $this->displayRemarks = $yr->remarks;
            $this->result = $yr->result;

        }

        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
        foreach ($this->campaignList as $list){
            $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
            $this->lawfirmList = DB::table('notes')->select('lawfirm')->where('campaign',$this->campaign)->distinct()->get();
            break;
        }
    }

    public function mount($page,$folder){
        $this->folderName = $folder;
        $pst = auth()->user()->position;
        if ($pst != "Super Admin"){
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

    public function submitEdit(){
        if ($this->campaign == "selectCampaign"){
            $this->campaign = "n/a";
        }
        if ($this->client == "selectClient"){
            $this->client = "n/a";
        }
        if ($this->lawfirm == "selectLawfirm"){
            $this->lawfirm = "n/a";
        }
        if ($this->base == false){
            if ($this->altPhoneNumber != "" or $this->altPhoneNumber != null){
                $this->validate([
                    'altPhoneNumber' => 'required|numeric',
                ]);
            }
            if ($this->caseType == "self"){
                $this->validate([
                    'phoneNumber' => 'required|numeric',
                    'ssn' => 'required|numeric',
                    'campaign' => 'required',
                    'date' => 'required',
                    'agent' => 'required',
                    'claimant' => 'required',
                    'coach' => 'required',
                    'client' => 'required',
                    'lawfirm' => 'required',
                    'caseType' => 'required',
                    'dob' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'verifier' => 'required',
                    'source' => 'required',
                ]);
            }else{
                $this->validate([
                    'phoneNumber' => 'required|numeric',
                    'ssn' => 'required|numeric',
                    'campaign' => 'required',
                    'lawfirm' => 'required',
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
                ]);
            }
            if ($this->result == "Pending"){
                $this->result = "";
            }
            if ($this->result == "DQ - Other reason"){
                $this->result = "DQ - ".$this->dqReason;
            }
            if ($this->result == "Return by Client"){
                $this->result = "Return by client - ".$this->returnClient;
            }
            try {
//                $res = implode(', ', $this->remarks);
                $kk = \App\Models\DtvTracker::find($this->ids);
                $kk->date = $this->date;
                $kk->agent = $this->agent;
                $kk->claimant = $this->claimant;
                $kk->phoneNumber = $this->phoneNumber;
                $kk->altPhoneNumber = $this->altPhoneNumber;
                $kk->campaign = $this->campaign;
                $kk->coach = $this->coach;
//                $kk->remarks = $res;
                $kk->client = $this->client;
                $kk->lawfirm = $this->lawfirm;
                $kk->caseType = $this->caseType;
                $kk->injuredParty = $this->injuredParty;
                $kk->dob = $this->dob;
                $kk->email = $this->email;
                $kk->address = $this->address;
                $kk->ssn = $this->ssn;
                $kk->verifier = $this->verifier;
                $kk->source = $this->source;
                $kk->user_name = $this->fullname;
                $kk->user_id = $this->user_id;
                $kk->result = $this->result;
                $kk->save();
                $this->dqReason = "";
                $this->returnClient = "";
                \App\Models\Logs::create([
                    'action' => "Edit dupe checker with a customer phone number ".$this->phoneNumber,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
                $this->is_success = true;
                $this->dispatch('dupeSubmitted');
            }catch (\Exception $e){
                $this->is_success = false;
                $this->dispatch('dupeSubmitted');
            }
        }
        else{
            if ($this->result == "DQ - Other reason"){
                $this->result = "DQ - ".$this->dqReason;
            }
            if ($this->result == "Return by Client"){
                $this->result = "Return by client - ".$this->returnClient;
            }
            try {
                $kk = \App\Models\DtvTracker::find($this->ids);
                $kk->result = $this->result;
                $kk->save();
                $this->dqReason = "";
                $this->returnClient = "";
                \App\Models\Logs::create([
                    'action' => "Edit dupe checker with a customer phone number ".$this->phoneNumber,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
                $this->is_success = true;
                $this->dispatch('dupeSubmitted');
            }catch (\Exception $e){
                $this->is_success = false;
                $this->dispatch('dupeSubmitted');
            }

        }

    }

    public function displayData(){
        $this->submissionData = \App\Models\DtvTracker::query()
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
    }

    public function previousPage(){
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        $this->currentPage++;
    }

    public function viewDetail(){
        for ($i=0; count($this->checkBox) > $i; $i++){
            $this->ids = $this->checkBox[$i];
        }
        $dv = \App\Models\DtvTracker::find($this->ids);
        $this->customer = $dv->name;
        $this->phoneNumber = $dv->phone_num;
        $this->altPhoneNumber = $dv->alt_num;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->service = $dv->service;
        $this->package = $dv->package;
        $this->disposition = $dv->disposition;
        $this->result = $dv->result;
        $this->description = $dv->description;
        $this->orderNumber = $dv->orderNumber;
        $this->date = $dv->date;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
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

    public function removeSearch(){
        $this->showSearch = false;
    }

    public function removeSearchVerifier(){
        $this->showSearchVerifier = false;
    }

    public function removeSearchCoach(){
        $this->showSearchCoach = false;
    }

    public function click_items($id){
        $gh = Employee::find($id);
        $this->agent = $gh->fname.' '.$gh->lname;
        $this->showSearchCoach = false;
    }

    public function clickEdit(){
        $this->base = false;
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

    public function delete(){
        for ($i=0; count($this->checkBox) > $i; $i++){
            $jk = \App\Models\DtvTracker::find($this->checkBox[$i]);
            $gn = $jk->phoneNumber;
            $jk->delete();
            \App\Models\Logs::create([
                'action' => "Delete phone number ".$gn." from DTV tracker",
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
        }
        $this->checkBox = [];
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
            if ($this->campaign == "selectCampaign" or $this->campaign == "na"){
                $this->campaignList = Note::select('campaign')
                    ->distinct('campaign')
                    ->get();
                $this->client = "selectClient";
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

        }
//        if ($field == "campaign"){
//            $this->clientList = DB::table('notes')->select('client')->where('campaign',$this->campaign)->distinct()->get();
//        }
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
