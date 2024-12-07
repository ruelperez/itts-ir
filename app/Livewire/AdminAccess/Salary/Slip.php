<?php

namespace App\Livewire\AdminAccess\Salary;

use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class Slip extends Component
{
    public $users, $search, $status = '1';

    public function render()
    {
        // Query users based on search and status
        $this->users = User::query()
            ->when($this->status !== 'all', function ($query) {
                $query->whereHas('employee', function ($subQuery) {
                    $subQuery->where('status', $this->status);
                });
            })
            ->when($this->search, function ($query) {
                $query->where('fullname', 'like', "%{$this->search}%");
            })
            ->with(['employee' => function ($query) {
                $query->select('id', 'user_id', 'status', 'dailyRate');
            }])
            ->get();
        return view('livewire.admin-access.salary.slip');
    }

    public function mount(){

    }
}
