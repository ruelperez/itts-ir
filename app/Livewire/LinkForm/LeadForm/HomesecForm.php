<?php

namespace App\Livewire\LinkForm\LeadForm;

use App\Models\Employee;
use App\Models\HomesecTracker;
use App\Models\Note;
use Livewire\Component;

class HomesecForm extends Component
{
    public $campaignName, $results = [], $date, $referenceCityZip, $distanceTimeDiff, $claimant, $phoneNumber, $email, $address, $desciption, $altPhoneNumber, $coach, $source = "", $gm = 0, $resultsCoach = [], $showSearch = false, $showSearchCoach = false, $dtvRemarks, $agent;
    public function render()
    {
        return view('livewire.link-form.lead-form.homesec-form');
    }

    public function submitHomeSec(){
        if ($this->gm == 0){
            session()->flash('badAgent', "Successfully saved");
            return;
        }
        $this->validate([
            'phoneNumber' => ['required', 'regex:/^[0-9]+$/'],
            'altPhoneNumber' => ['required', 'regex:/^[0-9]+$/'],
        ]);
        try {
            HomesecTracker::create([
                'date' => $this->date,
                'name' => $this->claimant,
                'phone_num' => $this->phoneNumber,
                'alt_num' => $this->altPhoneNumber,
                'email' => $this->email,
                'address' => $this->address,
                'disposition' => $this->dtvRemarks,
                'description' => $this->desciption,
                'agent' => $this->agent,
                'coach' => $this->coach,
                'source' => $this->source,
                'referenceCityZip' => $this->referenceCityZip,
                'distanceTimeDiff' => $this->distanceTimeDiff,
            ]);
            $this->clearInput();
            $this->dispatch('submitSuccess');
        }catch (\Exception $e){
            $this->dispatch('submitFailed');
        }
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

    public function removeSearch(){
        $this->showSearch = false;
    }

    public function removeSearchCoach(){
        $this->showSearchCoach = false;
    }

    public function clear(){
        $this->clearInput();
    }

    public function clearInput(){
        $this->phoneNumber = "";
        $this->altPhoneNumber = "";
        $this->email = "";
        $this->address = "";
        $this->agent = "";
        $this->coach = "";
        $this->source = "";
        $this->dtvRemarks = "";
        $this->desciption = "";
        $this->date = "";
        $this->referenceCityZip= "";
        $this->distanceTimeDiff= "";
        $this->claimant = "";
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

    public function click_itemsCoach($id){
        $gh = Employee::find($id);
        $this->coach = $gh->fname.' '.$gh->lname;
        $this->showSearchCoach = false;
    }

    public function click_items($id){
        $gh = Employee::find($id);
        $this->agent = $gh->fname.' '.$gh->lname;
        $this->showSearchCoach = false;
        $this->gm = 1;
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

    public function updated($field){
        if ($field == "dtvRemarks"){
            $this->desciption = "";
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
