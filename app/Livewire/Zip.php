<?php

namespace App\Livewire;

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
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Zip extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $dtrData = [], $employeeData, $superAdminSwitch, $position, $adminSwitch, $is_admin, $webName, $fullname, $user_id, $photo, $searchInput, $request_data=[];

    public function render()
    {
        if ($this->searchInput != ""){
            $this->search();
        }
        else{
            $this->request_data = \App\Models\Zip::all();
        }
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = \App\Models\Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = \App\Models\Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        return view('livewire.zip')->title('Zip code checker');
    }

    public function mount($name){
        $this->webName = $name;
    }

    public function search(){
        $this->request_data = DB::table('zips')
            ->where('zip_code','LIKE', '%'.$this->searchInput.'%')
            ->get();
    }

}
