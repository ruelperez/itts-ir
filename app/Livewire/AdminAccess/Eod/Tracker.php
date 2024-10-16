<?php

namespace App\Livewire\AdminAccess\Eod;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tracker extends Component
{
    public $start, $end, $submissionData = [], $salesData = [], $pages, $campaignName, $subject;

    public function render()
    {
        return view('livewire.admin-access.eod.tracker');
    }

    public function mount($page){
        $this->subject = preg_replace('/[^A-Za-z0-9]+.*/', '', $page);
        if ($page == "masstort-tracker"){
            $this->pages = "submission";
        }
        else{
            $this->pages = $page;
        }

        $this->campaignName = ucfirst(explode('-', $page)[0]);

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
            if ($this->pages == "submission") {
                $start = Carbon::createFromFormat('m/d/Y', $this->start)->startOfDay();
                $end = Carbon::createFromFormat('m/d/Y', $this->end)->endOfDay();

                $this->salesData = $model::select('campaign', DB::raw('COUNT(campaign) as count'))
                    ->whereBetween(
                    DB::raw('STR_TO_DATE(date, "%m/%d/%Y")'),
                    [$start, $end]
                    )
                    ->where('result', 'Signed / Executed')
                    ->groupBy('campaign')
                    ->get();
            }
            elseif ($this->pages == "dtv-tracker"){
                $start = Carbon::createFromFormat('m/d/Y', $this->start)->startOfDay();
                $end = Carbon::createFromFormat('m/d/Y', $this->end)->endOfDay();

                $this->salesData = $model::whereBetween(
                        DB::raw('STR_TO_DATE(date, "%m/%d/%Y")'),
                        [$start, $end]
                    )
                    ->where('result', 'Signed / Executed')
                    ->groupBy('campaign')
                    ->get();
            }

        }
    }
}
