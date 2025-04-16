<?php

namespace App\Livewire\AdminAccess\Employee;

use App\Models\LeaveForm;
use Livewire\Component;

class LeaveApproval extends Component
{
    public $datas = [], $selectedLeaveId, $selectedAction, $adjustedDate;

    public function render()
    {
        $this->datas = \App\Models\LeaveForm::orderByRaw('remark IS NOT NULL')
            ->latest()
            ->get();
        return view('livewire.admin-access.employee.leave-approval');
    }

    public function updateRemark()
    {
        $leave = LeaveForm::find($this->selectedLeaveId);

        if (!$leave) {
            return;
        }

        if ($this->selectedAction == 'Adjusted') {
            $leave->remark = $this->adjustedDate;
        } else {
            $leave->remark = $this->selectedAction;
        }

        $leave->save();

        $this->dispatch('success'); // Trigger SweetAlert
    }

}
