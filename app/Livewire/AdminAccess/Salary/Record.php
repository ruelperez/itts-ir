<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\SalaryDateInterval;
use Livewire\Component;

class Record extends Component
{
    public $start, $end, $data = [], $search;
    public function render()
    {
        if ($this->search != ""){
            $this->data = SalaryDateInterval::where('start',$this->search)
                ->orWhere('end',$this->search)
                ->get();
        }else{
            $this->data = SalaryDateInterval::latest()->get();
        }
        return view('livewire.admin-access.salary.record');
    }
    public function submit(){
        $this->validate([
            'start' => 'required',
            'end' => 'required',
        ]);
        try {
            SalaryDateInterval::create([
                'start' => $this->start,
                'end' => $this->end,
            ]);
            $this->start = "";
            $this->end = "";
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('failed');
        }

    }
}
