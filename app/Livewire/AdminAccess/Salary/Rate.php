<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\Employee;
use App\Models\SalaryDetail;
use Livewire\Component;

class Rate extends Component
{
    public $data = [], $search, $empID, $name, $basic, $nightDiff, $allowance, $holiday, $ot, $other;

    public function render()
    {
        $this->data = Employee::find($this->empID)
            ->salary_detail()
            ->orderBy('created_at', 'desc') // Order by created_at column, descending (latest to oldest)
            ->get();
        return view('livewire.admin-access.salary.rate');
    }

    public function mount($id){
        $this->empID = $id;
        $this->name = Employee::find($id)->employeeFullname;
    }

    public function submit(){
        $validatedData = $this->validate();
        try {
            SalaryDetail::create([
                'employee_id' => $this->empID,
                'basic' => $this->basic,
                'nightDiff' => $this->nightDiff,
                'allowance' => $this->allowance,
                'holiday' => $this->holiday,
                'ot' => $this->ot,
                'other' => $this->other,
            ]);
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('failed');
        }
    }

    protected $rules = [
        'basic'      => 'required|numeric',
        'nightDiff'  => 'required|numeric',
        'allowance'  => 'required|numeric',
        'holiday'    => 'required|numeric',
        'ot'         => 'required|numeric',
        'other'      => 'required|numeric',
    ];

    protected $messages = [
        'required' => 'This field is required.',
        'numeric'  => 'This field must be a number.',
    ];


}
