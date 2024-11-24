<?php

namespace App\Livewire;

use App\Models\Callback;
use App\Models\Note;
use Livewire\Component;

class MyCallback extends Component
{
    public $submissionData = [], $dob, $user_id, $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
            $gm=0, $results = [], $showSearch = false, $currentPage = 1, $perPage = 15, $callbackTime;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->submissionData = Callback::where('user_id', $this->user_id)
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
        return view('livewire.my-callback');
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

    public function submit(){
        if ($this->gm == 0){
            session()->flash('badAgent', "");
            return;
        }
        $this->validate([
            'phoneNumber' => 'required|numeric',
            'altPhoneNumber' => 'required|numeric',
        ]);

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
            'callbackTime' => $this->callbackTime,
            'reason' => $this->reason,
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
        $this->callbackTime = "";
        $this->reason = "";
    }

    public function updated($field){
        if ($field == "campaign"){
            $this->gm = 0;
            if ($this->campaign != ""){
                $this->results = Note::where('campaign','LIKE','%'. $this->campaign. '%')
                    ->where('campaign_stat','active')
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
    }

    public function removeSearch(){
        $this->showSearch = false;
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
