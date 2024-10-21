<?php

namespace App\Livewire\AdminAccess\Settings;

use App\Models\User;
use Livewire\Component;

class UserAccess extends Component
{
    public $datas = [], $currentPage = 1, $user_id, $user_fullname, $perPage = 15, $search, $user_position;
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

    protected $listeners = ['openPositionModal'=>'mod'];

    public function mod($id){
        $this->user_id = $id;
        $userAccess = User::find($this->user_id);
        $this->user_position = $userAccess->position;
        $this->user_fullname = $userAccess->fullname; // Assuming 'fullname' exists in the User model
        $this->dispatch('show-position-modal');
    }
    public function previousPage(){
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->settings;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
    }

    public function submitEditRole(){
        $ng = User::find($this->user_id);
        try {
            $ng->position = $this->user_position;
            $ng->save();
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('error');
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

}
