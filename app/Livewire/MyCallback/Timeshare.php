<?php

namespace App\Livewire\MyCallback;

use App\Models\TimeshareCallback;
use App\Models\User;
use Livewire\Component;

class Timeshare extends Component
{
    public $submissionData = [], $search, $dob, $user_id, $date, $claimant, $phoneNumber, $campaign = "Timeshare", $injuredParty, $altPhoneNumber, $email, $address, $reason,
        $gm=0, $results = [], $guest1, $guest2, $age1, $age2, $gift, $relationship, $state, $day, $time, $creditCard, $is_50k = "1", $is_firsTime = "1", $viewDqReason, $campName, $countUnmarked, $timeRemaining, $viewAnswered, $is_expired, $agent, $showSearch = false, $currentPage = 1, $perPage = 15;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        if ($this->search == ""){
            $this->displayData();
        }
        else{
            $this->submissionData = TimeshareCallback::where('user_id', auth()->id()) // Filter by logged-in user ID
            ->where(function ($query) {
                $query->where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(created_at, '%m/%d/%Y %h:%i %p') LIKE ?", ['%' . $this->search . '%']) // Civilian time format
                    ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('id', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('reason', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('is_expired', 'LIKE', '%' . (strtolower($this->search) === 'yes' ? 1 : (strtolower($this->search) === 'no' ? 0 : $this->search)) . '%'); // Yes/No to 1/0
            })
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }

        return view('livewire.my-callback.timeshare');
    }

    protected $listeners = ['viewDetail'=>'viewDetail'];

    public function displayData(){
        $this->submissionData = TimeshareCallback::where('user_id', $this->user_id)
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
        $info = TimeshareCallback::all();
        // Loop through each record and update its expiration status
        foreach ($info as $record) {
            $record->updateExpirationStatus(); // Update the expiration status
        }
    }
    public function submit(){
        $this->validate([
            'phoneNumber' => 'required|numeric',
            'altPhoneNumber' => 'required|numeric',
        ]);
        try {
            TimeshareCallback::create([
                'guest1' => $this->guest1,
                'guest2' => $this->guest2,
                'age1' => $this->age1,
                'age2' => $this->age2,
                'phoneNumber' => $this->phoneNumber,
                'altPhoneNumber' => $this->altPhoneNumber,
                'email' => $this->email,
                'campaign' => $this->campaign,
                'relationship' => $this->relationship,
                'state' => $this->state,
                'day' => $this->day,
                'time' => $this->time,
                'gift' => $this->gift,
                'creditCard' => $this->creditCard,
                'is_50k' => $this->is_50k,
                'is_firsTime' => $this->is_firsTime,
                'user_id' => $this->user_id,
                'reason' => $this->reason,
            ]);
            $this->phoneNumber = "";
            $this->altPhoneNumber = "";
            $this->email = "";
            $this->reason = "";
            $this->guest1 = "";
            $this->guest2 = "";
            $this->age1 = "";
            $this->age2 = "";
            $this->relationship = "";
            $this->state = "";
            $this->day = "";
            $this->time = "";
            $this->gift = "";
            $this->creditCard = "";
            $this->is_50k = "1";
            $this->is_firstTime = "1";
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('failed');
        }

    }

    public function closeBtn(){
        $this->phoneNumber = "";
        $this->altPhoneNumber = "";
        $this->campaign = "";
        $this->email = "";
        $this->reason = "";
        $this->is_expired = "";
        $this->timeRemaining = "";
        $this->guest1 = "";
        $this->guest2 = "";
        $this->age1 = "";
        $this->age2 = "";
        $this->relationship = "";
        $this->state = "";
        $this->day = "";
        $this->time = "";
        $this->gift = "";
        $this->creditCard = "";
        $this->is_50k = "";
        $this->is_firstTime = "";
    }

    public function viewDetail($id){
        $dv = TimeshareCallback::find($id);
        $this->guest1 = $dv->guest1;
        $this->guest2 = $dv->guest2;
        $this->age1 = $dv->age1;
        $this->age2 = $dv->age2;
        $this->relationship = $dv->relationship;
        $this->state = $dv->state;
        $this->day = $dv->day;
        $this->time = $dv->time;
        $this->gift = $dv->gift;
        $this->creditCard = $dv->creditCard;
        $this->is_50k = $dv->is_50k;
        $this->is_firsTime = $dv->is_firsTime;
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->email = $dv->email;
        $this->campaign = $dv->campaign;
        $this->timeRemaining = $dv->timeRemaining;
        $this->reason = $dv->reason;
        $this->is_expired = $dv->is_expired;
        $this->date = $dv->created_at->format('m/d/Y h:i A');
        $ja = User::find($dv->user_id);
        $this->agent = $ja->fullname;
        $this->dispatch('show-detailss-modal');
    }
}
