<?php

namespace App\Livewire\AdminAccess\Callback;

use App\Models\Callback;
use App\Models\User;
use Livewire\Component;

class Tracker extends Component
{
    public $submissionData = [], $search, $dob, $user_id, $date, $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
    $gm=0, $results = [], $timeRemaining, $is_expired, $agent, $showSearch = false, $currentPage = 1, $perPage = 15;

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

        return view('livewire.admin-access.callback.tracker');
    }

    public function displayData(){
        $this->submissionData = Callback::with('user') // Load the related user data
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
        $ja = User::find($dv->user_id);
        $this->agent = $ja->fullname;
    }
}
