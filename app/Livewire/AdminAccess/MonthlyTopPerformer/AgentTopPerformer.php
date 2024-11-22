<?php

namespace App\Livewire\AdminAccess\MonthlyTopPerformer;

use App\Models\DisplayMonth;
use App\Models\Employee;
use App\Models\TopPerformer;
use Livewire\Component;

class AgentTopPerformer extends Component
{
    public $month, $data, $ids, $fullname, $gm = 0, $rank, $empId, $showSearch = false, $results = [], $monthView, $sale, $submission, $qa, $attendance;
    public function render()
    {
        $this->data = TopPerformer::where('month',$this->monthView)
            ->orderBy('rank', 'asc')
            ->get();
        return view('livewire.admin-access.monthly-top-performer.agent-top-performer');
    }

    public function edit($id){
        $this->ids = $id;
        $bg = TopPerformer::find($id);
        $this->rank = $bg->rank;
        $this->fullname = $bg->fullname;
        $this->sale = $bg->sale;
        $this->submission = $bg->submission;
        $this->qa = $bg->qa;
        $this->attendance = $bg->attendance;
        $this->month = $bg->month;
    }

    public function submitEdit(){
        if ($this->gm == 0){
            session()->flash('badAgent', "Successfully saved");
            return;
        }
        try {
            $bg = TopPerformer::find($this->ids);
            $bg->rank = $this->rank;
            $bg->fullname =  $this->fullname;
            $bg->sale = $this->sale;
            $bg->submission = $this->submission;
            $bg->qa = $this->qa;
            $bg->attendance = $this->attendance;
            $bg->month = $this->month;
            $bg->save();
            $this->rank = "";
            $this->fullname = "";
            $this->sale = "";
            $this->submission = "";
            $this->qa = "";
            $this->attendance = "";
            $this->month = "";
            $this->gm == 0;
        }catch (\Exception $e){

        }

    }

    public function delete($id){
        TopPerformer::find($id)->delete();
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
            $this->gm == 0;
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
