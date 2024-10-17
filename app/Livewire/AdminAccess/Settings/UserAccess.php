<?php

namespace App\Livewire\AdminAccess\Settings;

use Livewire\Component;

class UserAccess extends Component
{
    public $datas = [], $currentPage = 1, $perPage = 15, $search;
    public function render()
    {
        $this->dispatch('acc');
        if ($this->search == ""){
            $this->datas = \App\Models\UserAccess::with('user:id,fullname,position,photo')
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }else{
            $this->datas = \App\Models\UserAccess::with('user:id,fullname,position,photo')
                ->whereHas('user', function ($query) {
                    $query->where('fullname', 'like', '%' . $this->search . '%')
                        ->orWhere('position', 'like', '%' . $this->search . '%');
                })
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.admin-access.settings.user-access');
    }

    public function previousPage(){
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function nextPage()
    {
        $this->currentPage++;
    }
    public function update_data($id,$column)
    {
        $userAccess = \App\Models\UserAccess::find($id);
        $userAccess[$column] = !$userAccess[$column];
        $userAccess->save();
        // Emit an event to show a success message after updating
        $this->dispatch('accessUpdated');
    }

    public function updateData(){
        dd('cacaca');
    }
}
