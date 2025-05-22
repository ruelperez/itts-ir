<?php

namespace App\Livewire\AdminAccess\Callback;

use App\Models\Callback;
use App\Models\TimeshareCallback;
use App\Models\User;
use Livewire\Component;

class Tracker extends Component
{
    public $submissionData = [], $search, $dob, $user_id, $date, $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
    $gm=0, $results = [], $guest1, $guest2, $age1, $age2, $state, $relationship, $gift, $day, $time, $creditCard, $is_50k, $is_firsTime, $timeRemaining,  $dqReason, $viewAnswered, $shouldPoll = true, $user_fullname, $viewDqReason, $countUnmarked, $ids, $remark, $is_expired, $agent, $showSearch = false, $currentPage = 1, $perPage = 15;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $this->user_fullname = auth()->user()->fullname;
        if ($this->search == ""){
            $this->displayData();
        }
        else{
            $this->submissionData = TimeshareCallback::with('user') // Eager load the related user
            ->where(function ($query) {
                $query->where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhereRaw("DATE_FORMAT(created_at, '%m/%d/%Y %h:%i %p') LIKE ?", ['%' . $this->search . '%']) // Civilian time format
                    ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('guest1', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('guest2', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('age1', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('age2', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('relationship', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('state', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('creditCard', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('reason', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('is_expired', 'LIKE', '%' . (strtolower($this->search) === 'yes' ? 1 : (strtolower($this->search) === 'no' ? 0 : $this->search)) . '%')
                    ->orWhereHas('user', function ($userQuery) {
                        $userQuery->where('fullname', 'LIKE', '%' . $this->search . '%'); // Match fullname directly
                    });
            })
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.admin-access.callback.tracker');
    }

    public function displayData(){
        $this->submissionData = TimeshareCallback::with('user') // Load the related user data
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

    public function submitEditRemark(){
        $this->validate([
            'remark' => 'required',
        ]);
        try {
            $jj = TimeshareCallback::find($this->ids);
            $jj->remark = $this->remark;
            $jj->markBy = $this->user_fullname;
            $jj->dqReason = $this->dqReason;
            $jj->save();
            $this->remark = "";
            $this->dqReason = "";
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('error');
        }
    }

    protected $listeners = ['openRemarksModal'=>'mod',
        'enablePolling' => 'enablePolling', 'openDetailsModal' => 'openDetailsModal'];

    public function enablePolling()
    {
        $this->shouldPoll = true;
    }

    public function openDetailsModal($id){
        $dv = TimeshareCallback::find($id);
        $this->guest1 = $dv->guest1;
        $this->guest2 = $dv->guest2;
        $this->age1 = $dv->age1;
        $this->age2 = $dv->age2;
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->email = $dv->email;
        $this->state = $dv->state;
        $this->campaign = $dv->campaign;
        $this->relationship = $dv->relationship;
        $this->gift = $dv->gift;
        $this->day = $dv->day;
        $this->time = $dv->time;
        $this->creditCard = $dv->creditCard;
        $this->is_50k = $dv->is_50k;
        $this->is_firsTime = $dv->is_firsTime;
        $this->reason = $dv->reason;
        $this->timeRemaining = $dv->timeRemaining;
        $this->is_expired = $dv->is_expired;
        $this->date = $dv->created_at->format('m/d/Y h:i A');
        $ja = User::find($dv->user_id);
        $this->agent = $ja->fullname;
        $this->dispatch('show-detail-modal');
    }

    public function mod($id){
        $this->ids = $id;
        $gb = TimeshareCallback::find($id);
        $this->remark = $gb->remark;
        $this->shouldPoll = false;
        $this->dispatch('show-remark-modal');
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
        $this->viewDqReason = "";
        $this->dqReason = "";
    }

    public function viewDetail($id){
        $dv = TimeshareCallback::find($id);
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
    }
}
