<?php

namespace App\Livewire\Eod\Masstort;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EmployeeSalesReport extends Component
{
    public $start, $end, $submissionData = [], $salesData = [], $pages, $campaignName, $subject;

    public function render()
    {
        return view('livewire.eod.masstort.employee-sales-report');
    }

    public function mount($pages){
        $this->pages = $pages;
    }

    public function generate(){
        $this->validate([
            'start' => 'required|date_format:m/d/Y',
            'end' => 'required|date_format:m/d/Y',
        ]);

        $converted = str_replace(' ', '', ucwords(str_replace('-', ' ', $this->pages)));
        $model = "\\App\\Models\\".$converted;

        $start_date = Carbon::createFromFormat('m/d/Y', $this->start)->startOfDay();
        $end_date = Carbon::createFromFormat('m/d/Y', $this->end)->endOfDay();


        if ($end_date->lt($start_date)) {
            $this->submissionData = [];
            $this->dispatch('error');
        }
        else{
            $start = Carbon::createFromFormat('m/d/Y', $this->start)->startOfDay();
            $end = Carbon::createFromFormat('m/d/Y', $this->end)->endOfDay();

            $this->salesData = $model::select('agent','campaign', DB::raw('COUNT(*) as count'))
                ->whereBetween(
                    DB::raw('STR_TO_DATE(date, "%m/%d/%Y")'),
                    [$start, $end]
                )
                ->where('result', 'Signed / Executed')
                ->groupBy('agent','campaign')
                ->get();
        }
    }
}
