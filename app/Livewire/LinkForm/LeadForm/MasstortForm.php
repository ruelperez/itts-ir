<?php

namespace App\Livewire\LinkForm\LeadForm;
use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\LeadLog;
use App\Models\Note;
use App\Models\Submission;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class MasstortForm extends Component
{

    public $registrationSwitch, $hostingTrans, $gm = 0, $gm2 = 0, $DQ, $jn, $toChecked = false, $comment, $caseType = "self", $is_success = false, $showSearch = false, $showSearch2 = false, $showSearchCoach = false, $results = [], $results2 = [], $resultsCoach = [], $clientList = [], $campaignList = [], $campaign = "selectCampaign", $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
            $date, $cplCheck = false, $leadOwnership, $mll = 0, $agent2, $campaignName, $displayComment = false, $orderNumber, $desciption, $service, $package, $dateSales, $submission = [], $checkboxDQ, $lawfirm = "selectLawfirm", $bam, $bbb, $client = "selectClient", $bms, $dtvRemarks, $remarks = [], $claimant, $checkboxTO = [], $lawfirmList = [], $injuredParty, $phoneNumber, $turnover, $checkboxInvalidTO, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source = "", $resultsVerifier = [], $showSearchVerifier = false ;

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
        return view('livewire.link-form.lead-form.masstort-form');
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

    public function submit(){
        if ($this->gm2 == 0){
            session()->flash('badAgent2', "Successfully saved");
            return;
        }
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
                'leadOwnership' => 'required',
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
                'leadOwnership' => 'required',
            ]);
        }
        if ($this->toChecked == true){
           $res = $this->checkboxTO[0].' - '.$this->turnover;
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
            $sub_id = Submission::create([
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
                'method' => $this->bbb->method,
                'leadOwnership' => $this->leadOwnership,
                'agent2' => $this->agent2,
            ]);
            $recentSubId = $sub_id->id;
            LeadLog::create([
                'user_name' => $this->fullname,
                'submission_id' => $recentSubId,
                'action' => 'Initial submission',
                'date' => $this->date,
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
        $this->source = "";
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
        $this->mll = 0;
        $this->leadOwnership = "";
        $this->agent2 = "";
    }
    public function clear(){
        $this->clearInput();
    }

    public function removeSearch(){
        $this->showSearch = false;
    }
    public function removeSearch2(){
        $this->showSearch2 = false;
    }

    public function removeSearchVerifier(){
        $this->showSearchVerifier = false;
    }

    public function removeSearchCoach(){
        $this->showSearchCoach = false;
    }

    public function click_items($id){
        $gh = Employee::find($id);
        $this->agent = $gh->employeeFullname;
        $this->showSearchCoach = false;
        $this->gm = 1;
    }
    public function click_items2($id){
        $gh = Employee::find($id);
        $this->agent2 = $gh->employeeFullname;
        $this->gm2 = 1;
    }

    public function click_itemsVerifier($id){
        $gh = Employee::find($id);
        $this->verifier = $gh->employeeFullname;
        $this->showSearchVerifier = false;
    }
    public function click_itemsCoach($id){
        $gh = Employee::find($id);
        $this->coach = $gh->employeeFullname;
        $this->showSearchCoach = false;
    }

    public function mount($page){
        $this->campaignName = explode('-', $page)[0];
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

    public function clickTO(){
        if ($this->checkboxTO == []){
           $this->mll = 0;
            $this->toChecked = false;
        }
        elseif ($this->checkboxTO[0] == "TO"){
            $this->mll = 1;
            if ($this->toChecked == false){
                $this->toChecked = true;
                $this->remarks = [];
            }
            else{
                $this->toChecked = false;

            }
        }
        elseif ($this->checkboxTO[0] == "Invalid TO"){
            $this->mll = 2;
            if ($this->toChecked == false){
                $this->toChecked = true;
                $this->remarks = [];
            }
            else{
                $this->toChecked = false;
            }
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

    public function handleOwnershipChange(){
    }

    public function updated($field){
        if ($field == "leadOwnership"){
            if ($this->leadOwnership == "1st Touch"){
                $this->agent2 = "";
                $this->gm2 = 1;
            }
            elseif($this->leadOwnership == "" or $this->leadOwnership == null){
                $this->agent2 = "";
                $this->gm2 = 1;
            }
        }
        if ($field == "subject"){
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
                $this->resultsVerifier = Employee::where('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('employeeFullname','LIKE','%'. $this->verifier. '%')
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
                $this->resultsCoach = Employee::where('employeeFullname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('employeeFullname','LIKE','%'. $this->coach. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('employeeFullname','LIKE','%'. $this->coach. '%')
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
                $this->results = Employee::where('employeeFullname','LIKE','%'. $this->agent. '%')
                    ->take(5)
                    ->get();
                $this->showSearch = true;
            }
            else{
                $this->showSearch = false;
                $this->results = [];
            }
        }
        if ($field == "agent2"){
            $this->gm2 = 0;
            if ($this->agent2 != ""){
                $this->results2 = Employee::where('employeeFullname','LIKE','%'. $this->agent2. '%')
                    ->take(5)
                    ->get();
                $this->showSearch2 = true;
            }
            else{
                $this->showSearch2 = false;
                $this->results2 = [];
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
    }
}
