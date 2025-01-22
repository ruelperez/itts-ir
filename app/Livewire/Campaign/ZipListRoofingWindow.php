<?php

namespace App\Livewire\Campaign;

use App\Models\RoofingWindowZip;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ZipListRoofingWindow extends Component
{
    public $registrationSwitch, $dtrData = [], $currentPage = 1, $totalPages, $perPage = 50, $employeeData, $superAdminSwitch, $position, $adminSwitch, $is_admin, $webName, $fullname, $user_id, $photo, $searchInput, $request_data=[];
    public function render()
    {
        if ($this->searchInput != ""){
            $this->search();
        }
        else{
            $this->request_data = RoofingWindowZip::query()
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->get();
        }
        return view('livewire.campaign.zip-list-roofing-window');
    }
    public function search(){
        $trimmedSearch = trim($this->searchInput);
        $searchQuery = RoofingWindowZip::where('zip', 'like', "%{$trimmedSearch}%");
        $this->request_data = $searchQuery
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();
    }
    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->request_data = RoofingWindowZip::query()
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->get();
        }
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages) {
            $this->currentPage++;
            $this->request_data = RoofingWindowZip::query()
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->get();
        }
    }
}
