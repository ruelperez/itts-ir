<?php

namespace App\Livewire\MyCallback;

use Livewire\Component;

class Timeshare extends Component
{
    public $submissionData = [], $search, $dob, $user_id, $date, $claimant, $phoneNumber, $campaign, $injuredParty, $altPhoneNumber, $email, $address, $reason,
        $gm=0, $results = [], $viewDqReason, $campName, $countUnmarked, $timeRemaining, $viewAnswered, $is_expired, $agent, $showSearch = false, $currentPage = 1, $perPage = 15;

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
        return view('livewire.my-callback.timeshare');
    }
}
