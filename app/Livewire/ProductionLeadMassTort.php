<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\IsRegistration;
use App\Models\MyNote;
use App\Models\Note;
use App\Models\Submission;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class ProductionLeadMassTort extends Component
{

    public $registrationSwitch, $search = "", $currentPage = 1, $caseType, $claimant, $injuredParty, $fname, $lname, $agentName, $perPage = 15, $submissionData = [], $employeeData, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $phoneNumber, $altPhoneNumber, $dob, $email, $address, $ssn, $agent, $coach, $verifier, $source;

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
            $this->submissionData = Submission::where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('agent', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('caseType', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('claimant', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('injuredParty', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                ->where('agent', $this->agentName)
                ->orWhere('remarks', 'LIKE', '%' . $this->search . '%')
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
        return view('livewire.production-lead-mass-tort');
    }

    public function viewDetail($id)
    {
        $dv = Submission::find($id);
        $this->caseType = $dv->caseType;
        if ($this->caseType == "obo") {
            $this->claimant = $dv->claimant;
            $this->injuredParty = $dv->injuredParty;
        } else {
            $this->claimant = $dv->claimant;
        }
        $this->phoneNumber = $dv->phoneNumber;
        $this->altPhoneNumber = $dv->altPhoneNumber;
        $this->dob = $dv->dob;
        $this->email = $dv->email;
        $this->address = $dv->address;
        $this->ssn = $dv->ssn;
        $this->agent = $dv->agent;
        $this->coach = $dv->coach;
        $this->verifier = $dv->verifier;
        $this->source = $dv->source;
    }

    public function displayData()
    {
        $this->submissionData = Submission::query()
            ->where('agent', $this->agentName)
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
