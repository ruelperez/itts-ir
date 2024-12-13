<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\DtrContent;
use App\Models\SalaryDeduction;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DailyDtr extends Component
{
    public $ids, $authorizer, $sss = 0, $ph = 0, $addtional=[], $other = 0, $content_name, $content_id, $ca = 0, $lateDeduction = 0, $totalDeduction = 0, $isLoading = false, $task, $userID = [], $employeeData, $role = "all", $year, $month, $day, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->generate();
        return view('livewire.admin-access.salary.daily-dtr');
    }

    protected $listeners = [
        'gen' => 'generated',
    ];

    public function generated(){

    }
    public function submit(){
        $validatedData = $this->validate();
        try {
            SalaryDeduction::create([
                'sss' => $this->sss,
                'ph' => $this->ph,
                'ca' => $this->ca,
                'other' => $this->other,
                'lateDeduction' => $this->lateDeduction,
                'totalDeduction' => $this->totalDeduction,
                'dtr_content_id' => $this->content_id,
            ]);
            session()->flash('success', 'Successfully saved.');
        }catch (\Exception $e){
            session()->flash('failed', 'Failed to saved.');
        }

    }

    public function view_more($id)
    {
        $this->content_name = DtrContent::find($id)->fullname;
        // Retrieve the specific DtrContent by ID along with its related salary_deduction
        $this->addtional = DtrContent::with('salary_deduction') // Load the related salary_deduction
        ->find($id); // Find the specific DtrContent record

        if (!$this->addtional) {
            // If the DtrContent does not exist, handle the case (e.g., show error or redirect)
            return abort(404, 'Record not found');
        }
    }

    public function generate()
    {
        // Combine year, month, and day to form the date
        $dt = $this->year . '-' . $this->month . '-' . $this->day;

        // Retrieve data where the DATE part of 'in' column matches $dt
        $this->dtrData = DtrContent::whereDate('in', $dt)->get();

        // Append additional columns for display
        foreach ($this->dtrData as $key => $data) {
            // Retrieve the latest total column value from salary_details table
            $latestSalaryDetail = DB::table('salary_details')
                ->where('user_id', $data->user_id)
                ->latest('created_at') // Sort by latest created_at
                ->value('total'); // Retrieve only the 'total' column

            $totalDeduction = DtrContent::find($data->id)
                ->salary_deduction() // Relationship method
                ->latest() // Order by latest record
                ->first()?->totalDeduction ?? 0; // Safely access totalDeduction or default to 0

            // Combine the two values into a single key 'salary_summary'
            $this->dtrData[$key]->salary_summary = [
                'salary_total' => $latestSalaryDetail ?? 0,
                'total_deduction' => $totalDeduction ?? 0,
            ];
        }

        // Dispatch event for front-end (if needed)
        $this->dispatch('loadingsss');
    }

    protected $rules = [
        'sss' => 'required|numeric',
        'ph'  => 'required|numeric',
        'ca'  => 'required|numeric',
        'lateDeduction'    => 'required|numeric',
        'totalDeduction'   => 'required|numeric',
        'other'  => 'required|numeric',
    ];

    protected $messages = [
        'required' => 'This field is required.',
        'numeric'  => 'This field must be a number.',
    ];

    public function deduct($id){
        $this->content_id = $id;
        $this->content_name = DtrContent::find($id)->fullname;
        $gg = DtrContent::find($id)->salary_deduction()->latest()->first();
        if ($gg){
            $this->sss = $gg->sss;
            $this->ph = $gg->ph;
            $this->ca = $gg->ca;
            $this->lateDeduction = $gg->lateDeduction;
            $this->totalDeduction = $gg->totalDeduction;
            $this->other = $gg->other;
        }

    }
    public function mount($page){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $this->authorizer = $fe->dtr_record;
        if ($this->authorizer){

        }
        else{
            return redirect('/');
        }
        $this->webName = $page;
        $this->month = date('m');
        $this->year = date('Y');
        $this->day = date('d');
        $this->day--;

//        $dt = $this->year . '-' . $this->month . '-' . $this->day;
//        $this->dtrData = DtrContent::whereDate('in', $dt)->get();
    }

    public function updated(){
        $validatedData = $this->validate();
        $this->totalDeduction = $this->lateDeduction + $this->sss + $this->ph + $this->ca + $this->other;
    }
}
