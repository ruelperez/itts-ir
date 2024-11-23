<?php

namespace App\Livewire;

use App\Models\Note;
use Livewire\Component;

class MyCallback extends Component
{
    public $submissionData = [], $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
            $gm=0, $results = [], $showSearch = false;

    public function render()
    {
        return view('livewire.my-callback');
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
