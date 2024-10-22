<?php

namespace App\Livewire\AdminAccess\UserCredential;

use App\Models\User;
use App\Models\UserPassword;
use Livewire\Component;

class KbtoolAccount extends Component
{
    public $staffData = [], $search, $currentPage = 1, $perPage = 15;

    public function render()
    {
        if ($this->search == ""){
            $this->staffData = User::select('users.*', 'employees.status') // Select all users and the status column
            ->leftJoin('employees', 'users.id', '=', 'employees.user_id') // Join the employees table
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
        }else{
            $this->staffData = User::select('users.*', 'employees.status') // Select all users and the status column
            ->leftJoin('employees', 'users.id', '=', 'employees.user_id') // Join the employees table
            ->where(function ($query) {
                $query->where('users.fullname', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('show_pass', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('username', 'LIKE', '%' . $this->search . '%');
            })
                ->latest() // Get the latest records first
                ->skip(($this->currentPage - 1) * $this->perPage) // Pagination logic
                ->take($this->perPage) // Pagination limit
                ->get();
        }
        return view('livewire.admin-access.user-credential.kbtool-account');
    }

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->user_credential;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
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
}
