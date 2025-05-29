<?php

namespace App\Livewire\LinkForm\LeadForm;

use App\Models\Employee;
use App\Models\Note;
use App\Models\Timeshare;
use App\Models\TimeshareLog;
use Livewire\Component;

class TimeshareForm extends Component
{
    public $registrationSwitch, $hostingTrans, $gm = 0, $gm2 = 0, $DQ, $jn, $toChecked = false, $comment, $caseType = "self", $is_success = false, $showSearch = false, $showSearch2 = false, $showSearchCoach = false, $results = [], $results2 = [], $resultsCoach = [], $client, $clientList = [], $gifts = [], $campaignList = [], $campaign = "Timeshare", $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $date, $leadOwnership, $mll = 0, $day, $reason, $gift, $time, $agent2, $campaignName, $guest1, $guest2, $displayComment = false, $orderNumber, $desciption, $service, $package, $dateSales, $submission = [], $checkboxDQ, $lawfirm = "selectLawfirm", $bam, $bbb, $clients = ['webinar','TOT - Orlando FL','NC - daytour','ANAHEIM - DAYTOUR (CA)'], $bms, $dtvRemarks, $remarks, $claimant, $checkboxTO = [], $lawfirmList = [], $injuredParty, $phoneNumber, $turnover, $checkboxInvalidTO, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source = "", $resultsVerifier = [], $showSearchVerifier = false ;


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
        return view('livewire.link-form.lead-form.timeshare-form');
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
        $this->validate([
            'leadOwnership' => 'required',
            'date' => 'required',
            'campaign' => 'required',
            'client' => 'required',
            'guest1' => 'required',
            'guest2' => 'required',
            'phoneNumber' => 'required|numeric',
            'altPhoneNumber' => 'required|numeric',
            'email' => 'required',
            'day' => 'required',
            'time' => 'required',
            'gift' => 'required',
            'agent' => 'required',
            'coach' => 'required',
            'verifier' => 'required',
            'source' => 'required',
            'remarks' => 'required',
        ]);
        try {
            $sub_id = Timeshare::create([
                'date' => $this->date,
                'campaign' => $this->campaign,
                'client' => $this->client,
                'guest1' => $this->guest1,
                'guest2' => $this->guest2,
                'phoneNumber' => $this->phoneNumber,
                'altPhoneNumber' => $this->altPhoneNumber,
                'email' => $this->email,
                'day' => $this->day,
                'time' => $this->time,
                'gift' => $this->gift,
                'agent' => $this->agent,
                'coach' => $this->coach,
                'verifier' => $this->verifier,
                'source' => $this->source,
                'user_name' => $this->fullname,
                'user_id' => $this->user_id,
                'leadOwnership' => $this->leadOwnership,
                'agent2' => $this->agent2,
                'remarks' => $this->remarks,
                'reason' => $this->reason,
            ]);

            $recentSubId = $sub_id->id;
            TimeshareLog::create([
                'user_name' => $this->fullname,
                'timeshare_id' => $recentSubId,
                'action' => $this->remarks,
                'date' => $this->date,
            ]);

            \App\Models\Logs::create([
                'action' => "Add submission with a customer phone number ".$this->phoneNumber,
                'user_id' => $this->user_id,
                'photo' => $this->photo,
                'fullname' => $this->fullname,
            ]);
            $this->clearInput();
            $this->bbb = null;
            $this->bam = null;
            $this->dispatch('submitSuccess');
        }catch (\Exception $e){
            $this->dispatch('submitFailed');
        }
    }

    public function clearInput(){
        $this->date = "";
       $this->guest1= "";
       $this->guest2= "";
        $this->phoneNumber = "";
      $this->altPhoneNumber= "";
       $this->email= "";
       $this->day= "";
       $this->time= "";
       $this->gift= "";
        $this->agent= "";
      $this->coach= "";
        $this->verifier= "";
       $this->source= "";
        $this->fullname= "";
        $this->user_id= "";
       $this->leadOwnership= "";
       $this->agent2= "";
       $this->remarks = "";
    }

    public function mount($page){
        $this->campaignName = explode('-', $page)[0];
        $this->campaignList = Note::select('campaign')
            ->distinct('campaign')
            ->get();
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

    public function updated($field){
//        'webinar','day TOT - Orlando FL','NC - daytour','ANAHEIM-DAYTOUR (CA)'
        if ($field == "client"){
            $this->gifts = [];
            if ($this->client == "webinar"){
                $this->gifts = [
                    'Roundtrip airfare for two people, plus hotel for two nights (23 locations).',
                    'Up to 7 nights accommodations at one of 3000 resorts/hotels worldwide.',
                    '3-day all-inclusive in Mexico or the Dominican Republic.',
                    'Open Choice (Not decided yet)',
                ];
            }
            elseif($this->client == "TOT - Orlando FL"){
                $this->gifts = [
                    '3 to 7-night Caribbean cruise  cruise for two adults.',
                    '2 round-trip airfares with a 2-night stay in your destination city.',
                    'Open Choice (Not decided yet)',
                ];
            }
            elseif($this->client == "NC - daytour"){
                $this->gifts = [
                    'Choice of 3. 4. 5- or 7-day cruise for two, plus airfare for two people.',
                    'Up to 7 nights hotel/resort.',
                    '3 day and 2-night airfare and hotel.',
                    'Open Choice (Not decided yet).',
                ];
            }
            elseif($this->client == "ANAHEIM - DAYTOUR (CA)"){
                $this->gifts = [
                    'Roundtrip airfare for two people, plus hotel for two nights (23 locations).',
                    'Up to 7 nights hotel accommodations at one of 3000 resorts/hotels worldwide.',
                    '3-day all-inclusive trip to Mexico or the Dominican Republic.',
                    '5-day and 4-night cruise for two people to Mexico or the Bahamas.',
                    'Open Choice (Not decided yet).',
                ];
            }
        }

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
        if ($field == "verifier"){
            if ($this->verifier != ""){
                $this->resultsVerifier = Employee::where('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Subject Matter Expert')
                    ->orWhere('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Team Leader')
                    ->orWhere('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Senior Team Leader')
                    ->orWhere('employeeFullname','LIKE','%'. $this->verifier. '%')
                    ->where('designation','Production Floor Manager/ Process Lead')
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
    }
}
