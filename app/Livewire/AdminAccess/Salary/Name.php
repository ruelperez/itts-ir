<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\Employee;
use Livewire\Component;

class Name extends Component
{
    public $data = [], $search;

    public function render()
    {
        if ($this->search != ""){
            $this->data = Employee::where('employeeFullname', 'LIKE', '%' . $this->search . '%')->get();
        }else{
            $this->data = Employee::where('status',1)->get();
        }
        return view('livewire.admin-access.salary.name');
    }
}
