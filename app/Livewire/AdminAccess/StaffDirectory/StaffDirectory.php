<?php

namespace App\Livewire\AdminAccess\StaffDirectory;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\DtrPermanent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Logs;
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

class StaffDirectory extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $registrationSwitch, $stat = [], $checkBox = [], $id_user, $ids, $ng = 0, $employeeData, $search, $dtrData = [], $empStat = "all", $staffData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo,
        $fname, $mname, $lname, $mi, $suffix, $age, $phone_number, $dob, $gender_preference, $civil_status, $religion, $personal_email, $current_house, $current_street,
        $current_brgy, $current_city, $current_working_email, $same_current_permanent = false, $permanent_house, $permanent_street, $is_success = true, $full_name,
        $permanent_brgy, $permanent_city, $currentPage = 1, $perPage = 15, $sss, $philhealth, $tin, $hire_date, $yot, $designation = "Agent / Sale Associate", $department = "Admin - Production", $contact_number, $address, $relationship;

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
        $this->dtrData = Dtr::all();
        if ($this->search != ""){
            $this->currentPage = 1;
            $this->empStat = "all";
            $this->staffData = \App\Models\Employee::select('employees.*', 'users.photo') // Select all users and the status column
            ->leftJoin('users', 'employees.user_id', '=', 'users.id') // Join the employees table
            ->where(function ($query) {
                $query->where('fname', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('lname', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('mi', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('mname', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('suffix', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('age', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('phone_number', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('dob', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('gender_preference', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('civil_status', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('religion', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('personal_email', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('current_house', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('current_street', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('current_brgy', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('current_city', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('current_working_email', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('permanent_house', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('permanent_street', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('permanent_brgy', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('permanent_city', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('sss', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('philhealth', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('tin', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('hire_date', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('yot', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('designation', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('department', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('contact_number', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('address', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('relationship', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('employees.branch', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('employees.fullname', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('id_user', 'LIKE', '%'.$this->search.'%');
            })

                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
            foreach ($this->staffData as $index => $staff){
                $this->stat[$index] = $staff->status;
            }
        }
        else{
            if ($this->empStat == "all"){
                $this->staffData = Employee::select('employees.*', 'users.photo') // Select all users and the status column
                ->leftJoin('users', 'employees.user_id', '=', 'users.id') // Join the employees table
                ->skip(($this->currentPage - 1) * $this->perPage)
                ->take($this->perPage)
                ->latest()
                ->get();
                foreach ($this->staffData as $index => $staff){
                    $this->stat[$index] = $staff->status;
                }
                $this->dispatch('remove-loading');
            }else{
                $this->staffData = Employee::select('employees.*', 'users.photo') // Select all users and the status column
                ->leftJoin('users', 'employees.user_id', '=', 'users.id') // Join the employees table
                ->where('status',$this->empStat)
                ->skip(($this->currentPage - 1) * $this->perPage)
                    ->take($this->perPage)
                    ->latest()
                    ->get();

//                $this->staffData = \App\Models\Employee::where('status',$this->empStat)
//                    ->skip(($this->currentPage - 1) * $this->perPage)
//                    ->take($this->perPage)
//                    ->latest()
//                    ->get();
                foreach ($this->staffData as $index => $staff){
                    $this->stat[$index] = $staff->status;
                }
                $this->dispatch('remove-loading');
            }

        }
        return view('livewire.admin-access.staff-directory.staff-directory');
    }

    public function previousPage(){
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    protected $listeners = [
        'previousPage' => 'previousPage',
        'nextPage'=> 'nextPage',
        'status' => 'status',
        'delete' => 'delete',
    ];

    public function updateForm(){
        $this->ng = 1;
        $this->is_success = false;
    }

    public function nextPage()
    {
        $this->currentPage++;
    }

    public function submitForm(){
        $this->ng = 1;
        $this->is_success = false;
        try {
            $pp = \App\Models\Employee::find($this->ids);
            $pp->fname = $this->fname;
            $pp->lname = $this->lname;
            $pp->mi = $this->mi;
            $pp->mname = $this->mname;
            $pp->suffix = $this->suffix;
            $pp->age = $this->age;
            $pp->phone_number = $this->phone_number;
            $pp->dob = $this->dob;
            $pp->gender_preference = $this->gender_preference;
            $pp->civil_status = $this->civil_status;
            $pp->religion = $this->religion;
            $pp->personal_email = $this->personal_email;
            $pp->current_house = $this->current_house;
            $pp->current_street = $this->current_street;
            $pp->current_brgy = $this->current_brgy;
            $pp->current_city = $this->current_city;
            $pp->current_working_email = $this->current_working_email;
            $pp->permanent_house = $this->permanent_house;
            $pp->permanent_street = $this->permanent_street;
            $pp->permanent_brgy = $this->permanent_brgy;
            $pp->permanent_city = $this->permanent_city;
            $pp->sss = $this->sss;
            $pp->philhealth = $this->philhealth;
            $pp->tin = $this->tin;
            $pp->hire_date = $this->hire_date;
            $pp->yot = $this->yot;
            $pp->designation = $this->designation;
            $pp->department = $this->department;
            $pp->branch = $this->branch;
            $pp->contact_number = $this->contact_number;
            $pp->address = $this->address;
            $pp->relationship = $this->relationship;
            $pp->fullname = $this->full_name;
            $pp->save();

            $ff = User::find($this->user_id);
            $ff->branch = $this->branch;
            $ff->save();

            $ff = User::find($this->user_id)->dtr;
            foreach ($ff as $gg){
                $aa = Dtr::find($gg->id);
                $aa->branch = $this->branch;
                $aa->save();
            }

            $ff = User::find($this->user_id)->dtr_permanent;
            foreach ($ff as $gg){
                $aa = DtrPermanent::find($gg->id);
                $aa->branch = $this->branch;
                $aa->save();
            }

            $ff = User::find($this->user_id)->dtr_content;
            foreach ($ff as $gg){
                $aa = DtrContent::find($gg->id);
                $aa->branch = $this->branch;
                $aa->save();
            }
            if ($this->is_create == true){
                return redirect('/');
            }
            $this->getInfo();
            $this->is_success = true;
            // Emit event to trigger modal
            $this->dispatch('formSubmitted');
        }catch (\Exception $e){
            $this->is_success = false;
        }
    }
    public function clickView(){
        for ($i=0; $i<count($this->checkBox); $i++){
            $this->ids = $this->checkBox[$i];
            $pp = \App\Models\Employee::find($this->ids);
            $this->branch = $pp->branch;
            $this->fname = $pp->fname;
            $this->lname = $pp->lname;
            $this->mi = $pp->mi;
            $this->mname = $pp->mname;
            $this->suffix = $pp->suffix;
            $this->age = $pp->age;
            $this->phone_number = $pp->phone_number;
            $this->dob = $pp->dob;
            $this->gender_preference = $pp->gender_preference;
            $this->civil_status = $pp->civil_status;
            $this->religion = $pp->religion;
            $this->personal_email = $pp->personal_email;
            $this->current_house = $pp->current_house;
            $this->current_street = $pp->current_street;
            $this->current_brgy = $pp->current_brgy;
            $this->current_city = $pp->current_city;
            $this->current_working_email = $pp->current_working_email;
            $this->permanent_house = $pp->permanent_house;
            $this->permanent_street = $pp->permanent_street;
            $this->permanent_brgy = $pp->permanent_brgy;
            $this->permanent_city = $pp->permanent_city;
            $this->sss = $pp->sss;
            $this->philhealth = $pp->philhealth;
            $this->tin = $pp->tin;
            $this->hire_date = $pp->hire_date;
            $this->yot = $pp->yot;
            $this->designation = $pp->designation;
            $this->department = $pp->department;
            $this->contact_number = $pp->contact_number;
            $this->address = $pp->address;
            $this->relationship = $pp->relationship;
            $this->full_name = $pp->fullname;
            $this->id_user = $pp->id_user;
            if ($this->department == "" or $this->department == null){
                $this->department = "Admin - Production";
                $this->designation = "Agent/ Sale Associate";
            }
        }
    }

    public function viewInfo(){

    }
    public function mount(){
        $pst = auth()->user()->position;
        if ($pst == "Super Admin"){

        }
        else{
            return redirect('/');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function delete(){
        try {
            for ($i=0; count($this->checkBox) > $i; $i++){
                $jk = Employee::find($this->checkBox[$i]);
                $gn = $jk->fullname;
                Comment::where('user_id', $jk->user_id)->delete();
                CommentHeart::where('user_id', $jk->user_id)->delete();
                Dtr::where('user_id', $jk->user_id)->delete();
                DtrContent::where('user_id', $jk->user_id)->delete();
                DtrPermanent::where('user_id', $jk->user_id)->delete();
                Logs::where('user_id', $jk->user_id)->delete();
                Note::where('user_id', $jk->user_id)->delete();
                TimeSetting::where('user_id', $jk->user_id)->delete();
                UserAccess::where('user_id', $jk->user_id)->delete();
                User::find($jk->user_id)->delete();
                $jk->delete();
                \App\Models\Logs::create([
                    'action' => "Delete employee named ".$gn,
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            $this->checkBox = [];
            $this->dispatch('success');
        }catch (\Exception $e){
            $this->dispatch('error');
        }

    }
    public function status($data){
        $indexNum = $data['index'];
        $id = $data['dataId'];
        $jk = \App\Models\Employee::find($id);
        $jk->status = $this->stat[$indexNum];
        $jk->save();
        $gg = User::find($jk->user_id);
        $hh = User::find($jk->user_id)->user_access->first();
        if($this->stat[$indexNum] == true){
            $u = "active";
            if ($gg->position == "Super Admin"){
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
                $hh->save();
            }else{
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
                if ($gg->position == "Admin"){
                    $hh->dtr_task= true;
                }else{
                    $hh->dtr_task= false;
                }
                $hh->save();
            }

        }
        else{
            $u = "inactive";
            $hh->can_login = false;
            $hh->dtr_record= false;
            $hh->campaign_settings= false;
            $hh->staff_directory= false;
            $hh->logs= false;
            $hh->eod= false;
            $hh->inventory= false;
            $hh->lead_tracker= false;
            $hh->user_credential= false;
            $hh->settings= false;
            $hh->dashboard_crud= false;
            $hh->faq_crud= false;
            $hh->login_special= false;
            $hh->dtr_task= false;
            $hh->save();
        }

        \App\Models\Logs::create([
            'action' => "set ".ucfirst($jk->fname).' '.ucfirst($jk->lname).' to '.$u,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);

        $this->dispatch('remove-loading');
    }

    public function boxCheck($indexNum,$id){
        $jk = \App\Models\Employee::find($id);

        if($this->stat[$indexNum] == true){
            $u = "active";
        }
        else{
            $u = "inactive";
        }

        \App\Models\Logs::create([
            'action' => "set ".ucfirst($jk->fname).' '.ucfirst($jk->lname).' to '.$u,
            'user_id' => $this->user_id,
            'photo' => $this->photo,
            'fullname' => $this->fullname,
        ]);
    }
}
