<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\DtrContent;
use App\Models\Employee;
use App\Models\SalaryDateInterval;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Slip extends Component
{
    public $users, $search, $status = '1', $data = [], $dataContents = [], $ids, $fullname, $selectDate, $dates;

    public function render()
    {
        $this->dates = SalaryDateInterval::latest()->get();
        $jj = SalaryDateInterval::find($this->selectDate);
        if ($jj){
            $startDate = Carbon::createFromFormat('m/d/Y', $jj->start)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('m/d/Y', $jj->end)->endOfDay()->format('Y-m-d H:i:s'); // End of day
            $query = DtrContent::select('dtr_contents.user_id', 'users.fullname', DB::raw('MAX(dtr_contents.in) as latest_in'))
                ->join('users', 'dtr_contents.user_id', '=', 'users.id')
                ->whereRaw("STR_TO_DATE(dtr_contents.in, '%Y-%m-%d %H:%i:%s') BETWEEN ? AND ?", [$startDate, $endDate])
                ->groupBy('dtr_contents.user_id', 'users.fullname');
            if ($this->search) {
                $query->where(function($query) {
                    $query->where('users.fullname', 'like', '%' . $this->search . '%')
                        ->orWhere('dtr_contents.user_id', 'like', '%' . $this->search . '%');
                });
            }
            $this->data = $query->get();
        }


        return view('livewire.admin-access.salary.slip');
    }

    public function clickName($userID)
    {
        $this->fullname = User::find($userID)->fullname;

        // Retrieve the interval based on the IDs property
        $jj = SalaryDateInterval::find($this->selectDate);

        // Convert start and end dates to 'Y-m-d H:i:s' format
        $startDate = Carbon::createFromFormat('m/d/Y', $jj->start)->startOfDay()->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('m/d/Y', $jj->end)->endOfDay()->format('Y-m-d H:i:s');

        // Retrieve records from dtr_contents table that match the conditions
        $this->dataContents = DB::table('dtr_contents')
            ->whereBetween('in', [$startDate, $endDate]) // Filter records within the date range
            ->where('user_id', $userID) // Match the given user ID
            ->get();

        // Retrieve the latest total column value from salary_details table
        $latestSalaryDetail = DB::table('salary_details')
            ->where('user_id', $userID)
            ->latest('created_at') // Sort by latest created_at
            ->value('total'); // Retrieve only the 'total' column

        // Append the latest total to the dataContents for display
        foreach ($this->dataContents as $key => $data) {
            $this->dataContents[$key]->latest_total = $latestSalaryDetail ?? 0; // Default to 0 if no total found
        }
    }
    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->paySlip;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
        $jj = SalaryDateInterval::latest()->first();
    }
}
