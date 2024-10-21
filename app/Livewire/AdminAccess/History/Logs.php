<?php

namespace App\Livewire\AdminAccess\History;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Logs extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $authorizer, $dtrData = [], $currentPage = 1, $perPage = 20, $employeeData, $position, $superAdminSwitch, $search, $logsData = [], $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->is_admin = auth()->user()->is_admin;
        $this->photo = auth()->user()->photo;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->dtrData = Dtr::all();
        if ($this->search == ""){
            $this->displayData();
        }else{
            $this->logsData = \App\Models\Logs::where('fullname','LIKE','%'.$this->search.'%')
                ->orWhere('action','LIKE','%'.$this->search.'%')
                ->orWhere('note_id','LIKE','%'.$this->search.'%')
                ->orWhere('updated_at','LIKE','%'.$this->search.'%')
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
        }
        return view('livewire.admin-access.history.logs');
    }

    public function displayData(){
        $this->logsData = \App\Models\Logs::query()
            ->skip(($this->currentPage - 1) * $this->perPage)
            ->take($this->perPage)
            ->latest()
            ->get();
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

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $this->authorizer = $fe->logs;
        if ($this->authorizer){

        }
        else{
            return redirect('/');
        }
    }

    public function updated($field)
    {
        if ($field == "search") {

        }
    }

}
