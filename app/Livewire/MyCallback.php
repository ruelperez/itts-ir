<?php

namespace App\Livewire;

use App\Models\Callback;
use App\Models\Note;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class MyCallback extends Component
{
    public $submissionData = [], $search, $dob, $user_id, $date, $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
            $gm=0, $results = [], $viewDqReason, $campName, $necQuestion = ['weight' => '',
        'birth_year' => '',
        'nec_diagnosis' => '',
        'formula' => '',
        'premature' => ''],
        $afffQuestion = ['member' => '',
        'exposed' => '',
        'firstExposure' => '',
        'lastExposure' => '',
        'howOften' => '',
        'qualifyingInjuries' => '',
        'diagnosis' => '',
        'dateOfDiagnosis' => '',
        'convicted' => '',],
        $rideshareQuestion = ['receipt' => '',
        'report' => '',
        'assaulted' => '',
        'incident' => '',
        'convicted' => '',
        'represented' => '',],$countUnmarked, $timeRemaining, $viewAnswered, $is_expired, $agent, $showSearch = false, $currentPage = 1, $perPage = 15;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        if ($this->search == ""){
            $this->displayData();
        }
        else{
            $this->submissionData = Callback::where('user_id', auth()->id()) // Filter by logged-in user ID
            ->where(function ($query) {
                $query->where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(created_at, '%m/%d/%Y %h:%i %p') LIKE ?", ['%' . $this->search . '%']) // Civilian time format
                    ->orWhere('claimant', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('injuredParty', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('dob', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('reason', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('is_expired', 'LIKE', '%' . (strtolower($this->search) === 'yes' ? 1 : (strtolower($this->search) === 'no' ? 0 : $this->search)) . '%'); // Yes/No to 1/0
            })
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        $gb = Callback::where(function ($query) {
            $query->where('remark', '')
                ->orWhere('remark', null);
        })
            ->where('user_id', $this->user_id)
            ->get();
        $this->countUnmarked = count($gb);
        return view('livewire.my-callback');
    }

    protected $listeners = ['viewDetail'=>'viewDetail'];

    public function displayData(){
        $this->submissionData = Callback::where('user_id', $this->user_id)
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


    public function mount(){
        $info = Callback::all();
        // Loop through each record and update its expiration status
        foreach ($info as $record) {
            $record->updateExpirationStatus(); // Update the expiration status
        }
    }

    public function resetQuestionnaire(){
        $this->necQuestion = [ 'birth_year' => '',
            'nec_diagnosis' => '',
            'formula' => '','premature' => ''];
        $this->afffQuestion = ['member' => '',
            'exposed' => '',
            'firstExposure' => '',
            'lastExposure' => '',
            'howOften' => '',
            'qualifyingInjuries' => '',
            'diagnosis' => '',
            'dateOfDiagnosis' => '',
            'convicted' => '',];
    }
    public function submit(){
        $formattedAnswers;
        if ($this->gm == 0){
            session()->flash('badAgent', "");
            return;
        }
        $this->validate([
            'phoneNumber' => 'required|numeric',
            'altPhoneNumber' => 'required|numeric',
        ]);
        if ($this->campaign == "nec" or $this->campaign == "NEC"){
            $formattedAnswers = implode('<br>', [
                "Weight - " . $this->necQuestion['weight'],
                "Birth Year - " . $this->necQuestion['birth_year'],
                "NEC Diagnosis - " . $this->necQuestion['nec_diagnosis'],
                "Formula - " . $this->necQuestion['formula'],
                "Premature - " . $this->necQuestion['premature'],
            ]);
        }
        elseif ($this->campaign == "afff" or $this->campaign == "AFFF"){
            $formattedAnswers = implode('<br>', [
                "Were you a FF, ER, or Military - " . $this->afffQuestion['member'],
                "Exposed to AFFF after 1980? - " . $this->afffQuestion['exposed'],
                "Is this your first exposure - " . $this->afffQuestion['firstExposure'],
                "What was your last exposure - " . $this->afffQuestion['lastExposure'],
                "How often are you exposed? - " . $this->afffQuestion['howOften'],
                "Diagnosed with a qualifying injury? - " . $this->afffQuestion['qualifyingInjuries'],
                "Diagnosis - " . $this->afffQuestion['diagnosis'],
                "Date of diagnosis - " . $this->afffQuestion['dateOfDiagnosis'],
                "convicted of a crime within the previous 5 years? - " . $this->afffQuestion['convicted'],
            ]);
        }
        elseif ($this->campaign == "rideshare uber/lyft" or $this->campaign == "RIDESHARE UBER/LYFT"){
            $formattedAnswers = implode('<br>', [
                "Copy of RS receipt - " . $this->rideshareQuestion['receipt'],
                "Copy of Police Report/Company Complain - " . $this->rideshareQuestion['report'],
                "𝐖𝐚𝐬 𝐬𝐞𝐱𝐮𝐚𝐥𝐥𝐲 𝐚𝐬𝐬𝐚𝐮𝐥𝐭𝐞𝐝 𝐛𝐲 𝐚 𝐫𝐢𝐝𝐞𝐬𝐡𝐚𝐫𝐞 𝐝𝐫𝐢𝐯𝐞𝐫? - " . $this->rideshareQuestion['assaulted'],
                "Did the incident occur in the United States? - " . $this->rideshareQuestion['incident'],
                "Were you convicted as felony? - " . $this->rideshareQuestion['convicted'],
                "Are you represented by other LF? - " . $this->rideshareQuestion['represented'],
            ]);
        }
        try {
            Callback::create([
                'claimant' => $this->claimant,
                'phoneNumber' => $this->phoneNumber,
                'altPhoneNumber' => $this->altPhoneNumber,
                'campaign' => $this->campaign,
                'injuredParty' => $this->injuredParty,
                'dob' => $this->dob,
                'email' => $this->email,
                'address' => $this->address,
                'user_id' => $this->user_id,
//                'callbackTime' => $this->callbackTime,
                'reason' => $this->reason,
                'answeredQuestion' => $formattedAnswers,
            ]);
            $this->claimant = "";
            $this->phoneNumber = "";
            $this->altPhoneNumber = "";
            $this->campaign = "";
            $this->injuredParty = "";
            $this->dob = "";
            $this->email = "";
            $this->address = "";
            $this->user_id = "";
            $this->reason = "";
            $this->resetQuestionnaire();
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('failed');
        }

    }

    public function closeBtn(){
        $this->claimant = "";
        $this->phoneNumber = "";
        $this->altPhoneNumber = "";
        $this->campaign = "";
        $this->injuredParty = "";
        $this->dob = "";
        $this->email = "";
        $this->address = "";
//        $this->callbackTime = "";
        $this->reason = "";
        $this->is_expired = "";
        $this->timeRemaining = "";
        $this->resetQuestionnaire();
    }

    public function viewDetail($id){
        $dv = Callback::find($id);
        $this->claimant = $dv->claimant;
        $this->injuredParty = $dv->injuredParty;
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->dob = $dv->dob;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->campaign = $dv->campaign;
        $this->timeRemaining = $dv->timeRemaining;
        $this->reason = $dv->reason;
        $this->is_expired = $dv->is_expired;
        $this->date = $dv->created_at->format('m/d/Y h:i A');
        $this->viewDqReason = $dv->dqReason;
        $this->viewAnswered = $dv->answeredQuestion;
        $ja = User::find($dv->user_id);
        $this->agent = $ja->fullname;
        $this->dispatch('show-detailss-modal');
    }

    public function updated($field){
        if ($field == "campaign"){
            $this->gm = 0;
            if ($this->campaign != ""){
                $this->results = Note::where('campaign','LIKE','%'. $this->campaign. '%')
                    ->take(5)
                    ->get();
                $this->showSearch = true;
            }
            else{
                $this->showSearch = false;
                $this->results = [];
            }
        }

//        if ($field == "agent"){
//            $this->gm = 0;
//            if ($this->agent != ""){
//                $this->results = Employee::where('employeeFullname','LIKE','%'. $this->agent. '%')
//                    ->take(5)
//                    ->get();
//                $this->showSearch = true;
//            }
//            else{
//                $this->showSearch = false;
//                $this->results = [];
//            }
//        }
    }

    public function click_items($id){
        $gh = Note::find($id);
        $this->campaign = $gh->campaign;
        $this->gm = 1;
        $this->campName = strtolower($gh->campaign);
    }

    public function removeSearch(){
        $this->showSearch = false;
        if (strtolower($this->campaign) == "afff" || strtolower($this->campaign) == "nec" || strtolower($this->campaign) == "rideshare uber/left"){
            $this->gm = 1;
            $this->campName = strtolower($this->campaign);
        }
        else{
            $this->campName = strtolower($this->campaign);
        }
    }

    public function naCampaign(){
        if ($this->campaign != "n/a"){
            $this->campaign = "n/a";
        }
    }

    public function naClaimant(){
        if ($this->claimant != "n/a"){
            $this->claimant = "n/a";
        }
    }
    public function naInjureParty(){
        if ($this->injuredParty != "n/a"){
            $this->injuredParty = "n/a";
        }
    }

    public function naDob(){
        if ($this->dob != "n/a"){
            $this->dob = "n/a";
        }
    }
    public function naPhoneNumber(){
        if ($this->phoneNumber != "00000"){
            $this->phoneNumber = "00000";
        }
    }
    public function naAltPhoneNumber(){
        if ($this->altPhoneNumber != "00000"){
            $this->altPhoneNumber = "00000";
        }
    }
    public function naEmail(){
        if ($this->email != "na@na"){
            $this->email = "na@na";
        }
    }
    public function naAddress(){
        if ($this->address != "n/a"){
            $this->address = "n/a";
        }
    }
}
