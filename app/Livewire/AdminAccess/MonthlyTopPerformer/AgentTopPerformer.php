<?php

namespace App\Livewire\AdminAccess\MonthlyTopPerformer;

use App\Models\DisplayMonth;
use App\Models\Employee;
use App\Models\TopPerformer;
use Livewire\Component;

class AgentTopPerformer extends Component
{
    public $month, $data, $fullname, $gm = 0, $rank, $empId, $showSearch = false, $results = [], $monthView, $sale, $submission, $qa, $attendance;
    public function render()
    {
        $this->monthView = DisplayMonth::first()->month;
        $this->data = TopPerformer::where('month',$this->monthView)
            ->orderBy('rank', 'asc')
            ->get();
        return view('livewire.admin-access.monthly-top-performer.agent-top-performer');
    }

    public function submit(){
        if ($this->gm == 0){
            session()->flash('badAgent', "Successfully saved");
            return;
        }
        try {
            TopPerformer::create([
                'month' => $this->month,
                'rank' => $this->rank,
                'fullname' => $this->fullname,
                'sale' => $this->sale,
                'submission' => $this->submission,
                'qa' => $this->qa,
                'attendance' =>$this->attendance,
                'user_id' => $this->empId,
            ]);
            $this->rank = "";
            $this->fullname = "";
            $this->sale = "";
            $this->submission = "";
            $this->qa = "";
            $this->attendance = "";
        }catch (\Exception $e){

        }

    }

    public function removeSearch(){
        $this->showSearch = false;
    }

    public function click_items($id){
        $gh = Employee::find($id);
        $this->fullname = $gh->employeeFullname;
        $this->empId = $gh->user_id;
        $this->gm = 1;
    }

    public function updated($field){
        if ($field == "monthView"){
            $hh = DisplayMonth::all();
            if (count($hh) > 0){
                $gh = DisplayMonth::first();
                $kk = DisplayMonth::find($gh->id);
                $kk->month = $this->monthView;
                $kk->save();
            }else{
                DisplayMonth::create([
                    'month' => $this->monthView,
                ]);
            }
        }
        if ($field == "fullname"){
            $this->gm = 0;
            if ($this->fullname != ""){
                $this->results = Employee::where('employeeFullname','LIKE','%'. $this->fullname. '%')
                    ->take(5)
                    ->get();
                $this->showSearch = true;
            }
            else{
                $this->showSearch = false;
                $this->results = [];
            }

        }
    }
}
