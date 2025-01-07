<?php

namespace App\Livewire\AdminAccess\LeadTracker;

use App\Exports\SearchResultsExport;
use App\Models\Employee;
use App\Models\Note;
use App\Models\Submission;
use App\Models\Timeshare;
use App\Models\TimeshareLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class TimeshareTracker extends Component
{
    public $registrationSwitch, $returnClient, $pageRange, $returnReason, $currentPage = 1, $totalPages, $perPage = 10, $is_success = false, $search, $ids, $displayRemarks, $checkBox = [], $submissionData = [], $resultsCoach = [], $employeeData, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo, $campaignList = [], $campaign,
        $date, $base = true, $day, $editDate, $editID, $gift, $time, $guest1, $guest2, $logsDate, $logsFullname, $leadLogsData = [], $logsAction, $toChecked = false, $leadOwnership, $agent2, $folderName, $lawfirm, $lawfirmList = [], $dqReason, $client, $remarks, $claimant, $injuredParty, $phoneNumber, $altPhoneNumber, $dob, $email, $address, $ssn, $showSearch = false, $showSearchCoach = false, $agent, $coach, $verifier, $source = "Dialer", $caseType = "self", $resultsVerifier = [], $results = [], $clientList= [], $showSearchVerifier = false, $result;


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
            $searchQuery = Timeshare::where('phoneNumber', 'LIKE', '%'.$this->search.'%')
                ->orWhere('altPhoneNumber', 'LIKE', '%'.$this->search.'%')
                ->orWhere('date', 'LIKE', '%'.$this->search.'%')
                ->orWhere('agent', 'LIKE', '%'.$this->search.'%')
                ->orWhere('campaign', 'LIKE', '%'.$this->search.'%')
                ->orWhere('remarks', 'LIKE', '%'.$this->search.'%')
                ->orWhere('coach', 'LIKE', '%'.$this->search.'%')
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
        return view('livewire.admin-access.lead-tracker.timeshare-tracker');
    }

    public function submitEditRemark(){
        $this->validate([
            'remarks' => 'required',
            'editDate' => 'required',
        ]);
        $gg = Timeshare::find($this->editID);
        try {
            $gg->remarks = $this->remarks;
            $gg->save();

            TimeshareLog::create([
                'user_name' => $this->fullname,
                'timeshare_id' => $this->editID,
                'action' => $this->remarks,
                'date' => $this->editDate,
            ]);

            \App\Models\Logs::create([
                'action' => "Edit timeshare detail with a customer phone number ".$this->phoneNumber,
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->dispatch('goodEditRemark');
        }catch (\Exception $e){
            $this->dispatch('badEditRemark');
        }
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
            $yr = Timeshare::find($this->checkBox[$i]);
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
        $this->totalPages = ceil(Timeshare::count() / $this->perPage);
        $this->displayData();
    }

    public function displayData()
    {
        $this->submissionData = Timeshare::query()
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
        $this->totalPages = ceil(Timeshare::count() / $this->perPage);
    }

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
        $dv = Timeshare::find($this->ids);
        $this->leadOwnership = $dv->leadOwnership;
        $this->date = $dv->date;
        $this->campaign = $dv->campaign;
        $this->client = $dv->client;
        $this->guest1 = $dv->guest1;
        $this->guest2 = $dv->guest2;
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->email = $dv->email;
        $this->agent2 = $dv->agent2;
        $this->day = $dv->day;
        $this->time = $dv->time;
        $this->gift = $dv->gift;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
        $this->verifier = $dv->verifier;
        $this->source = $dv->source;
       $this->remarks = $dv->remarks;


//        lead logs
//        $this->leadLogsData = Submission::find($this->ids)->lead_log;
        $this->leadLogsData = Timeshare::find($this->ids)->timeshare_log
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

    public function editRemark($id){
        $ff = Timeshare::find($id);
        $this->editID = $id;
        $this->phoneNumber = $ff->phoneNumber;
    }
}
