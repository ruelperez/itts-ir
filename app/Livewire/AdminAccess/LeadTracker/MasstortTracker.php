<?php

namespace App\Livewire\AdminAccess\LeadTracker;

use App\Exports\SearchResultsExport;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class MasstortTracker extends Component
{
    public $registrationSwitch, $returnClient, $pageRange, $returnReason, $currentPage = 1, $totalPages, $perPage = 10, $is_success = false, $search, $ids, $displayRemarks, $checkBox = [], $submissionData = [], $resultsCoach = [], $employeeData, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo, $campaignList = [], $campaign,
        $date, $base = true, $logsDate, $logsFullname, $leadLogsData = [], $logsAction, $toChecked = false, $leadOwnership, $agent2, $folderName, $lawfirm, $lawfirmList = [], $dqReason, $client, $remarks = [], $claimant, $injuredParty, $phoneNumber, $altPhoneNumber, $dob, $email, $address, $ssn, $showSearch = false, $showSearchCoach = false, $agent, $coach, $verifier, $source = "Dialer", $caseType = "self", $resultsVerifier = [], $results = [], $clientList= [], $showSearchVerifier = false, $result;

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
            $searchQuery = Submission::where('phoneNumber', 'LIKE', '%'.$this->search.'%')
                ->orWhere('altPhoneNumber', 'LIKE', '%'.$this->search.'%')
                ->orWhere('date', 'LIKE', '%'.$this->search.'%')
                ->orWhere('agent', 'LIKE', '%'.$this->search.'%')
                ->orWhere('caseType', 'LIKE', '%'.$this->search.'%')
                ->orWhere('claimant', 'LIKE', '%'.$this->search.'%')
                ->orWhere('injuredParty', 'LIKE', '%'.$this->search.'%')
                ->orWhere('campaign', 'LIKE', '%'.$this->search.'%')
                ->orWhere('remarks', 'LIKE', '%'.$this->search.'%')
                ->orWhere('coach', 'LIKE', '%'.$this->search.'%')
                ->orWhere('result', 'LIKE', '%'.$this->search.'%')
            ->orWhere('id', 'LIKE', '%'.$this->search.'%');

            // Get the results for the current page
            $this->submissionData = $searchQuery
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();

            // Count the total number of results for the search
            $this->totalPages = ceil($searchQuery->count() / $this->perPage);
        }
        $this->pageRange = $this->calculatePageRange();
        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
        return view('livewire.admin-access.'.$this->folderName.'.masstort-tracker');
    }

    public function export()
    {
        if ($this->search == ""){
            $this->dispatch('exportError');
        }
        else{
            return Excel::download(new SearchResultsExport($this->search), 'search_results.xlsx');
        }
    }

    public function calculatePageRange()
    {
        $rangeStart = max(1, $this->currentPage - 5); // Start range 5 pages before current
        $rangeEnd = min($this->totalPages, $rangeStart + 9); // End range 5 pages after current, but not more than total pages

        return range($rangeStart, $rangeEnd);
    }

    public function clearCheck(){
        $this->checkBox = [];
    }

    public function edit(){
        for ($i=0; count($this->checkBox) > $i; $i++){
            $this->ids = $this->checkBox[$i];
            $yr = Submission::find($this->checkBox[$i]);
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
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->lead_tracker;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
        $this->checkBox = [];
        $this->totalPages = ceil(Submission::count() / $this->perPage);
        $this->displayData();
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
                $kk = Submission::find($this->ids);
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
                $kk = Submission::find($this->ids);
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

    public function displayData()
    {
        $this->submissionData = Submission::query()
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
        $this->totalPages = ceil(Submission::count() / $this->perPage);
    }

//    public function previousPage(){
//        if ($this->currentPage > 1) {
//            $this->currentPage--;
//        }
//    }
//
//    public function nextPage()
//    {
//        $this->currentPage++;
//    }
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->displayData();
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->displayData();
        }
    }

    public function goToPage($page)
    {
        if ($page <= $this->totalPages) {
            $this->currentPage = $page;
            $this->displayData(); // Load data for the selected page
        }
    }

    public function viewDetail(){
        for ($i=0; count($this->checkBox) > $i; $i++){
            $this->ids = $this->checkBox[$i];
        }
        $dv = Submission::find($this->ids);
        $this->caseType = $dv->caseType;
        if ($this->caseType == "obo"){
            $this->claimant = $dv->claimant;
            $this->injuredParty = $dv->injuredParty;
        }
        else{
            $this->claimant = $dv->claimant;
        }
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->dob = $dv->dob;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->ssn = $dv->ssn;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
        $this->verifier = $dv->verifier;
        $this->source = $dv->source;
        $this->campaign = $dv->campaign;
        $this->client = $dv->client;
        $this->lawfirm = $dv->lawfirm;
        $this->date = $dv->date;
        $this->leadOwnership = $dv->leadOwnership;
        $this->agent2 = $dv->agent2;

//        lead logs
//        $this->leadLogsData = Submission::find($this->ids)->lead_log;
        $this->leadLogsData = Submission::find($this->ids)->lead_log
            ->sortByDesc(function ($log) {
                return Carbon::createFromFormat('m/d/Y', $log->date);
            });
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
            $jk = Submission::find($this->checkBox[$i]);
            $gn = $jk->phoneNumber;
            $jk->delete();
            \App\Models\Logs::create([
                'action' => "Delete phone number ".$gn." from Mass tort tracker",
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
        if ($field == "search"){
            $this->currentPage = 1;
        }
    }
}
