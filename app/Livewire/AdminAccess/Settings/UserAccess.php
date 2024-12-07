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
            $this->datas = \App\Models\UserAccess::select('user_accesses.*', 'users.photo','users.position','users.fullname', 'employees.status')
                ->leftJoin('users', 'user_accesses.user_id', '=', 'users.id') // Join users table
                ->leftJoin('employees', 'users.id', '=', 'employees.user_id') // Join employees table
                ->where('employees.status', true)
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();


//            $this->datas = \App\Models\UserAccess::with('user:id,fullname,position,photo')
//                ->where('status','1')
//                ->skip(($this->currentPage - 1) * $this->perPage)
//                ->take($this->perPage)
//                ->latest()
//                ->get();

        }else{
            $this->datas = \App\Models\UserAccess::select('user_accesses.*', 'users.photo','users.position','users.fullname', 'employees.status')
                ->leftJoin('users', 'user_accesses.user_id', '=', 'users.id') // Join users table
                ->leftJoin('employees', 'users.id', '=', 'employees.user_id') // Join employees table
                ->where(function ($query) {
                    $query->where('users.fullname', 'like', '%' . $this->search . '%')
                        ->orWhere('users.position', 'like', '%' . $this->search . '%');
                })
                ->where('employees.status', true)
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
        $hh = User::find($this->user_id)->user_access->first();
        try {
            $ng->position = $this->user_position;
            $ng->save();
            if ($this->user_position == "Super Admin"){
                $hh->can_login = true;
                $hh->dashboard_crud= true;
                $hh->dtr_record= true;
                $hh->campaign_settings= true;
                $hh->staff_directory= true;
                $hh->logs= true;
                $hh->eod= true;
                $hh->inventory= true;
                $hh->lead_tracker= true;
                $hh->user_credential= true;
                $hh->settings= true;
                $hh->faq_crud= true;
                $hh->login_special= true;
                $hh->dtr_task= false;
                $hh->paySlip= true;
                $hh->save();
            }
            else {
                $hh->can_login = true;
                $hh->dashboard_crud= false;
                $hh->dtr_record= false;
                $hh->campaign_settings= false;
                $hh->staff_directory= false;
                $hh->logs= false;
                $hh->eod= false;
                $hh->inventory= false;
                $hh->lead_tracker= false;
                $hh->user_credential= false;
                $hh->settings= false;
                $hh->faq_crud= false;
                $hh->login_special= false;
                $hh->paySlip= false;
                if ($this->user_position == "Admin"){
                    $hh->dtr_task= true;
                }else{
                    $hh->dtr_task= false;
                }
                $hh->save();
            }
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
