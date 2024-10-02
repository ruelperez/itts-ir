<?php

namespace App\Livewire;

use App\Models\Submission;
use Livewire\Component;

class ProductionLeadDtv extends Component
{
    public $registrationSwitch, $search = "", $currentPage = 1, $caseType, $claimant, $injuredParty, $fname, $lname, $agentName, $perPage = 15, $submissionData = [], $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $phoneNumber, $altPhoneNumber, $package, $date, $result, $orderNumber, $disposition, $description, $dob, $service, $customer, $email, $address, $ssn, $agent, $coach, $verifier, $source;

    public function render()
    {
        $this->user_id = auth()->user()->id;
        $jj = \App\Models\Employee::where('user_id', $this->user_id)->get();
        foreach ($jj as $yy) {
            $idss = $yy->id;
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
            $this->fname = $emp->fname;
            $this->lname = $emp->lname;
        }
        $this->agentName = $this->fname . ' ' . $this->lname;
        if ($this->search == "") {
            $this->displayData();
        } else {
            $this->submissionData = \App\Models\DtvTracker::where('phone_num', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('alt_num', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('name', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('address', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('service', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('package', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('disposition', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('description', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('orderNumber', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('agent', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('coach', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('result', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->where('agent', $this->agentName)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.production-lead-dtv');
    }

    public function viewDetail($id)
    {
        $dv = \App\Models\DtvTracker::find($id);
        $this->customer = $dv->name;
        $this->phoneNumber = $dv->phone_num;
        $this->altPhoneNumber = $dv->alt_num;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->service = $dv->service;
        $this->package = $dv->package;
        $this->disposition = $dv->disposition;
        $this->result = $dv->result;
        $this->description = $dv->description;
        $this->orderNumber = $dv->orderNumber;
        $this->date = $dv->date;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
//        $this->source = $dv->source;
    }

    public function displayData()
    {
        $this->submissionData = \App\Models\DtvTracker::query()
            ->where('agent', $this->agentName)
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
    }

    public function mount($name)
    {
        $this->webName = $name;
    }
}
