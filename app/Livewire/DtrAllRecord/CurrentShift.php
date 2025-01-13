<?php

namespace App\Livewire\DtrAllRecord;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CurrentShift extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $branch = "all", $earl = false, $authorizer, $search, $employeeData, $unchangeTimeIn1, $unchangeTimeIn2, $timeIn1, $dtrName, $ids, $timeIn2, $timeOut1, $timeOut2, $date, $dtrData = [], $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;
    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $jj = Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        if ($this->search == ""){
//            if ($this->branch == "all"){
//                $this->dtrData = DtrPermanent::all();
//            }
//            else{
//                $this->dtrData = DtrPermanent::where('branch',$this->branch)->get();
//            }
            $this->dtrData = DtrPermanent::latest('updated_at')->get();
        }else{
//            $this->dtrData = DtrPermanent::where('fullname','LIKE', '%'.$this->search.'%')
//                ->orWhere('branch', 'LIKE', '%'.$this->search.'%')->get();
            $this->dtrData = DtrPermanent::where('fullname','LIKE', '%'.$this->search.'%')->get();
        }
        $this->date = DtrPermanent::latest()->first();
        return view('livewire.dtr-all-record.current-shift');
    }

    public function remove(){
        DtrPermanent::find($this->ids)->delete();
    }

    public function clickTimeEdit($id){
        $this->ids =$id;
        $bn = DtrPermanent::find($id);
        $this->timeIn1 = $bn->in;
        $this->timeOut1 = $bn->out;
        $this->timeIn2 = $bn->in2;
        $this->timeOut2 = $bn->out2;
        $this->dtrName = $bn->fullname;
        $this->unchangeTimeIn1 = $bn->in;
        $this->unchangeTimeIn2 = $bn->in2;
        $this->earl = $bn->isEarlyOut;
    }

    public function submitNotEarly(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }
        try {
            $bn = DtrPermanent::find($this->ids);
            $bn->isEarlyOut = false;
            $bn->save();
            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }
    }


    public function submitEarly(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }
        try {
            $bn = DtrPermanent::find($this->ids);
            $bn->isEarlyOut = true;
            $bn->save();
            session()->flash('goodSched', 'Successfully saved');
        }catch (\Exception $e){
            session()->flash('badSched', 'Failed to save');
        }
    }

    public function submitEdit(){
        if ($this->timeIn1 != "early out"){
            $this->validate([
                'timeIn1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn1 == ""){
                $this->timeIn1 = null;
            }
        }
        if ($this->timeIn2 != "early out"){
            $this->validate([
                'timeIn2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeIn2 == ""){
                $this->timeIn2 = null;
            }
        }
        if ($this->timeOut1 != "early out"){
            $this->validate([
                'timeOut1' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut1 == ""){
                $this->timeOut1 = null;
            }
        }
        if ($this->timeOut2 != "early out"){
            $this->validate([
                'timeOut2' => ['nullable', 'date_format:Y-m-d H:i:s'],
            ]);
            if ($this->timeOut2 == ""){
                $this->timeOut2 = null;
            }
        }
        $bn = DtrPermanent::find($this->ids);
        if ($this->timeIn1 == "" and $this->timeOut1 == "" and $this->timeIn2 == "" and $this->timeOut2 == ""){
            try {
                $bn->delete();
                session()->flash('goodSched', 'Successfully saved');
            }catch (\Exception $e){
                session()->flash('badSched', 'Failed to save');
            }
        }
        else{
            try {
                $bn->in = $this->timeIn1;
                $bn->out = $this->timeOut1;
                $bn->in2 = $this->timeIn2;
                $bn->out2 = $this->timeOut2;
                $bn->is_edited = 1;
                $bn->save();
                session()->flash('goodSched', 'Successfully saved');
            }catch (\Exception $e){
                session()->flash('badSched', 'Failed to save');
            }
        }
    }

    public function mount(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $this->authorizer = $fe->dtr_record;
        if ($this->authorizer){

        }
        else{
            return redirect('/');
        }
    }
}
