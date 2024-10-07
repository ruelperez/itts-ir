<?php

namespace App\Livewire\Eod;

use App\Models\DtvTracker;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Tracker extends Component
{
    public $start, $end, $submissionData = [], $pages, $campaignName;

    public function render()
    {
        return view('livewire.eod.tracker');
    }

    public function mount($page){
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
            if ($this->pages == "submission"){
                $this->submissionData = DB::table('submissions')
                    ->select('result', DB::raw('count(result) as count'))
                    ->whereBetween('date', [
                        $start_date->format('m/d/Y'),
                        $end_date->format('m/d/Y'),
                    ])
                    ->where('result', '!=', 'Signed / Executed')  // Add condition for 'signed'
                    ->orWhere('result',null)
                    ->whereBetween('date', [
                        $start_date->format('m/d/Y'),
                        $end_date->format('m/d/Y'),
                    ])
                    ->groupBy('result')
                    ->get();
                dd($this->submissionData);
                // Retrieve records based on date range
//                $this->submissionData = Submission::whereBetween('date', [
//                    $start_date->format('m/d/Y'),
//                    $end_date->format('m/d/Y'),
//                ])
//                ->where('result','!=',"Signed / Executed")
//                ->orWhere('result',null)
//                ->whereBetween('date', [
//                    $start_date->format('m/d/Y'),
//                    $end_date->format('m/d/Y'),
//                ])
////                ->orWhere('result', '')
////                ->whereBetween('date', [
////                    $start_date->format('m/d/Y'),
////                    $end_date->format('m/d/Y'),
////                ])
//                ->get();
            }
            elseif ($this->pages == "dtv-tracker"){
                $data = DtvTracker::whereDate('date', '>=', $start_date)
                    ->whereDate('date', '<=', $end_date)
//                ->where('disposition','!=',"Sale")
                    ->get();
                dd($data);
                foreach ($data as $datas) {
                    $contain[] = $model::where('date', $datas->date)
                        ->where('result', '!=', 'Signed')
                        ->get();

                }
                $this->submissionData = $contain;
                dd($this->submissionData);
            }

        }
    }
}
