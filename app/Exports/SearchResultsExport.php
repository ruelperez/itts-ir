<?php

namespace App\Exports;

use App\Models\Submission;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SearchResultsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search;

    public function __construct($search)
    {
        $this->search = $search;
    }

    public function view(): View
    {
        $query = Submission::query();

        if (!empty($this->search)) {
            $query->where('phoneNumber', 'LIKE', '%' . $this->search . '%')
                ->orWhere('altPhoneNumber', 'LIKE', '%' . $this->search . '%')
                ->orWhere('date', 'LIKE', '%' . $this->search . '%')
                ->orWhere('agent', 'LIKE', '%' . $this->search . '%')
                ->orWhere('caseType', 'LIKE', '%' . $this->search . '%')
                ->orWhere('claimant', 'LIKE', '%' . $this->search . '%')
                ->orWhere('injuredParty', 'LIKE', '%' . $this->search . '%')
                ->orWhere('campaign', 'LIKE', '%' . $this->search . '%')
                ->orWhere('remarks', 'LIKE', '%' . $this->search . '%')
                ->orWhere('coach', 'LIKE', '%' . $this->search . '%')
                ->orWhere('result', 'LIKE', '%' . $this->search . '%')
                ->orWhere('id', 'LIKE', '%' . $this->search . '%');
        }

        return view('exports.search_results', [
            'submissionData' => $query->latest()->get()
        ]);
    }
}
