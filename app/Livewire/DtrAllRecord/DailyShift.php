<?php

namespace App\Livewire\DtrAllRecord;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserAccess;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class DailyShift extends Component
{
    public $ids, $authorizer, $isLoading = false, $task, $userID = [], $employeeData, $role = "all", $year, $month, $day, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;


    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        return view('livewire.dtr-all-record.daily-shift');
    }

    protected $listeners = [
        'gen' => 'generate',
    ];

    public function generate()
    {
        $gn = [];
        $this->dtrData = DtrContent::all();
        if ($this->role == "all"){
            $this->userID = [];
        }
        elseif ($this->role == "task executor"){
            $jn = UserAccess::where('dtr_task', 1)->get();
            foreach ($jn as $jj){
                $gn[] = User::find($jj->user_id);
            }
           $this->userID = $gn;
        }
        else{
            $this->userID = User::where('position',$this->role)->get();
        }

        $this->dispatch('loadingsss');
    }

    public function clickTask($id){
        $this->ids = $id;
        $data = DtrContent::find($id);
        $this->task = $data->task;
    }
    public function mount($page){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $this->authorizer = $fe->dtr_record;
        if ($this->authorizer){

        }
        else{
            return redirect('/');
        }
        $this->webName = $page;
        $this->month = date('m');
        $this->year = date('Y');
        $this->day = date('d');
        $this->day--;
        $this->dtrData = DtrContent::all();
        if ($this->role == "all"){
            $this->userID = [];
        }
        elseif ($this->role == "agent"){
            $this->userID = User::where('position',"Agent")->get();

        }
        else{
            $this->userID = User::where('position','!=',"Agent")->get();
        }
    }

    public function updated($field){
        if ($field == "task"){
            $data = DtrContent::find($this->ids);
            $data->task = $this->task;
            $data->save();
        }
    }
}
