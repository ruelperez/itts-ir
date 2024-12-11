<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\DtrContent;
use App\Models\SalaryDateInterval;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\Failed\DynamoDbFailedJobProvider;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AgentSalaryStatement extends Component
{
    public $ids, $data = [], $interval, $search, $dataContents = [], $fullname;

    public function render()
    {
        $jj = SalaryDateInterval::find($this->ids);
        $this->interval = $jj;

// Format the dates
        $startDate = Carbon::createFromFormat('m/d/Y', $jj->start)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('m/d/Y', $jj->end)->endOfDay()->format('Y-m-d H:i:s'); // End of day
        $this->getData($startDate, $endDate);
//        $this->data = DtrContent::select('dtr_contents.user_id', 'users.fullname', DB::raw('MAX(dtr_contents.in) as latest_in'))
//            ->join('users', 'dtr_contents.user_id', '=', 'users.id') // Join the users table
//            ->whereRaw("STR_TO_DATE(dtr_contents.in, '%Y-%m-%d %H:%i:%s') BETWEEN ? AND ?", [$startDate, $endDate])
//            ->groupBy('dtr_contents.user_id', 'users.fullname') // Group by user_id and fullname
//            ->get();

        return view('livewire.admin-access.salary.agent-salary-statement');
    }

    public function mount($id){
       $this->ids = $id;
    }

    public function clickName($userID)
    {
        $this->fullname = User::find($userID)->fullname;

        // Retrieve the interval based on the IDs property
        $jj = SalaryDateInterval::find($this->ids);

        // Convert start and end dates to 'Y-m-d H:i:s' format
        $startDate = Carbon::createFromFormat('m/d/Y', $jj->start)->startOfDay()->format('Y-m-d H:i:s');
        $endDate = Carbon::createFromFormat('m/d/Y', $jj->end)->endOfDay()->format('Y-m-d H:i:s');
        // Retrieve records from dtr_contents table that match the conditions
        $this->dataContents = DB::table('dtr_contents')
            ->whereBetween('in', [$startDate, $endDate]) // Filter records within the date range
            ->where('user_id', $userID) // Match the given user ID
            ->get();
    }

    public function getData($startDate, $endDate)
    {
        // Query with search condition if search value exists
        $query = DtrContent::select('dtr_contents.user_id', 'users.fullname', DB::raw('MAX(dtr_contents.in) as latest_in'))
            ->join('users', 'dtr_contents.user_id', '=', 'users.id')
            ->whereRaw("STR_TO_DATE(dtr_contents.in, '%Y-%m-%d %H:%i:%s') BETWEEN ? AND ?", [$startDate, $endDate])
            ->groupBy('dtr_contents.user_id', 'users.fullname');

// Apply the search filter if it's not empty
        if ($this->search) {
            $query->where(function($query) {
                $query->where('users.fullname', 'like', '%' . $this->search . '%')
                    ->orWhere('dtr_contents.user_id', 'like', '%' . $this->search . '%');
            });
        }

// Get the data and assign it to the public property
        $this->data = $query->get();
    }
}
