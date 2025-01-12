<?php

namespace App\Livewire;

use App\Models\Timeshare;
use Carbon\Carbon;
use Livewire\Component;

class ProductionLeadTimeshare extends Component
{
    public $registrationSwitch, $search = "", $currentPage = 1, $caseType, $claimant, $injuredParty, $fname, $lname, $agentName, $perPage = 15, $submissionData = [], $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $phoneNumber, $date, $guest1, $reason, $guest2, $age1, $age2, $relationship, $gift, $leadLogsData = [], $altPhoneNumber, $leadOwnership, $agent2, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source, $campaign, $lawfirm, $client, $result, $remarks;


    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = \App\Models\Employee::where('user_id', $this->user_id)->get();
        foreach ($jj as $yy) {
            $idss = $yy->id;
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
            $this->fname = $emp->fname;
            $this->lname = $emp->lname;
        }
        $this->agentName = $this->fname . ' ' . $this->lname;
        $this->photo = auth()->user()->photo;
        if ($this->search == "") {
            $this->displayData();
        } else {
            $this->submissionData = Timeshare::where(function ($query) {
                $query->where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('guest1', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('guest2', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('agent', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('remarks', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('id', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('coach', 'LIKE', '%' . $this->search . '%');
            })
                ->where(function ($query) {
                    $query->where('agent', $this->agentName)
                        ->orWhere('agent2', $this->agentName);
                })
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.production-lead-timeshare');
    }

    public function viewDetail($id)
    {
        $dv = Timeshare::find($id);
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->email = $dv->email;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
        $this->verifier = $dv->verifier;
        $this->source = $dv->source;
        $this->campaign = $dv->campaign;
        $this->client = $dv->client;
        $this->remarks = $dv->remarks;
        $this->date = $dv->date;
        $this->leadOwnership = $dv->leadOwnership;
        $this->agent2 = $dv->agent2;
        $this->guest1 = $dv->guest1;
        $this->guest2 = $dv->guest2;
        $this->gift = $dv->gift;
        $this->reason = $dv->reason;

        //        lead logs
//        $this->leadLogsData = Submission::find($this->ids)->lead_log;
        $this->leadLogsData = Timeshare::find($id)->timeshare_log
            ->sortByDesc(function ($log) {
                return Carbon::createFromFormat('m/d/Y', $log->date);
            });

    }

    public function displayData()
    {
        $this->submissionData = Timeshare::query()
            ->where('agent', $this->agentName)
            ->orWhere('agent2', $this->agentName) // Add this line for the additional condition
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        $this->currentPage++;
    }

    public function mount($name)
    {
        $this->webName = $name;
    }
}
