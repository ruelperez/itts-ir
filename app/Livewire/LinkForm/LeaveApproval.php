<?php

namespace App\Livewire\LinkForm;

use App\Models\Employee;
use Livewire\Component;

class LeaveApproval extends Component
{
    public $datas = [], $employeeName;
    public function render()
    {
        $this->datas = \App\Models\LeaveForm::with('employee')
            ->orderByRaw('ISNULL(remark) DESC') // remark IS NULL will be on top
            ->latest() // Optional: within each group, order by latest
            ->get();
        return view('livewire.link-form.leave-approval');
    }

}
