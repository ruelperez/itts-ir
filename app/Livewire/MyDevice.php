<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class MyDevice extends Component
{
    public $registrationSwitch, $mydeviceSearch, $status = "all", $showSearch = false, $ids, $srl, $brand_name, $deviceData = [], $inventory_id, $results = [], $device_name, $serial, $quantity = 1, $employeeData, $dtrData = [], $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;

    public function render()
    {
        $this->fullname = auth()->user()->fullname;
        $this->user_id = auth()->user()->id;
        $this->position = auth()->user()->position;
        $jj = Employee::where('user_id',$this->user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $this->employeeData = $emp->designation;
        }
        $this->photo = auth()->user()->photo;
        $this->dtrData = Dtr::all();
        if ($this->mydeviceSearch == ""){
            if ($this->status == "all"){
                $this->deviceData = \App\Models\MyDevice::where('user_id',$this->user_id)
                    ->orderBy('created_at', 'desc')->get();
            }
            elseif ($this->status == "active"){
                $this->deviceData = \App\Models\MyDevice::where('user_id',$this->user_id)
                    ->where('status','deployed')
                    ->orderBy('created_at', 'desc')->get();
            }
            elseif ($this->status == "returned"){
                $this->deviceData = \App\Models\MyDevice::where('user_id',$this->user_id)
                    ->where('status','returned')
                    ->orderBy('created_at', 'desc')->get();
            }
            elseif ($this->status == "declined"){
                $this->deviceData = \App\Models\MyDevice::where('user_id',$this->user_id)
                    ->where('status','declined')
                    ->orderBy('created_at', 'desc')->get();
            }
        }
        else{
            $this->deviceData = \App\Models\MyDevice::where('user_id',$this->user_id)
                ->where('name','LIKE', '%'.$this->mydeviceSearch.'%')
                ->orWhere('serial', 'LIKE', '%'.$this->mydeviceSearch.'%')
                ->where('user_id',$this->user_id)
                ->orWhere('status', 'LIKE', '%'.$this->mydeviceSearch.'%')
                ->where('user_id',$this->user_id)
                ->orWhere('name', 'LIKE', '%'.$this->mydeviceSearch.'%')
                ->where('user_id',$this->user_id)
                ->orWhere('brand_name', 'LIKE', '%'.$this->mydeviceSearch.'%')
                ->where('user_id',$this->user_id)
                ->get();
        }

        return view('livewire.my-device')->title('My device');
    }

    public function removeSearch(){
        $this->showSearch = false;
    }

    public function clickSearch(){
        if ($this->serial != ""){
            $this->results = \App\Models\Inventory::where('serial','LIKE','%'. $this->serial. '%')
                ->where('status','stocked')->get();
            $this->showSearch = true;
        }
        else{
            $this->showSearch = false;
            $this->results = [];
        }
    }

    public function mount($name){
        $this->webName = $name;
        $usrId = auth()->user()->id;
        $sd = \App\Models\Employee::where('user_id',$usrId)->get();
        if (count($sd) < 1){
            return redirect('/itts/15/employee');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function clickSettings(){
        $data = IsRegistration::all();
        if (count($data) == 0){
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = IsRegistration::all();
        foreach ($an as $ans){
            $this->registrationSwitch = $ans->on_off;
        }
        if ($this->registrationSwitch == "0"){
            $this->registrationSwitch = false;
        }
        else{
            $this->registrationSwitch = true;
        }


        $data = AdminShow::all();
        if (count($data) == 0){
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = AdminShow::all();
        foreach ($an as $ans){
            $this->adminSwitch = $ans->on_off;
        }
        if ($this->adminSwitch == "0"){
            $this->adminSwitch = false;
        }
        else{
            $this->adminSwitch = true;
        }

        $data = SuperadminShow::all();
        if (count($data) == 0){
            SuperadminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
        $an = SuperadminShow::all();
        foreach ($an as $ans){
            $this->superAdminSwitch = $ans->on_off;
        }
        if ($this->superAdminSwitch == "0"){
            $this->superAdminSwitch = false;
        }
        else{
            $this->superAdminSwitch = true;
        }
    }

    public function regSwitch(){
        $data = IsRegistration::all();
        if (count($data) == 1){
            if ($this->registrationSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = IsRegistration::all();
                foreach ($an as $ans){
                    $this->registrationSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
        else{
            IsRegistration::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
        }
    }

    public function admin_Switch(){
        $data = AdminShow::all();
        if (count($data) == 1){
            if ($this->adminSwitch == false){
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
            else{
                foreach ($data as $datas){
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = AdminShow::all();
                foreach ($an as $ans){
                    $this->adminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
        else{
            AdminShow::create([
                'user_id' => auth()->user()->id,
                'on_off' => true,
            ]);
            $an = AdminShow::all();
            foreach ($an as $ans){
                $this->adminSwitch = $ans->on_off;
            }
        }
    }

    public function cancelApproval($id){
        $this->ids = $id;
        $tu = \App\Models\MyDevice::find($id);
        $this->srl = $tu->serial;
    }

    public function cancelItemApproval(){
        try {
            $tr = \App\Models\MyDevice::find($this->ids);
            $hh = \App\Models\Inventory::find($tr->inventory_id);
            $hh->status = "stocked";
            $hh->save();
            \App\Models\MyDevice::find($this->ids)->delete();
            session()->flash('good', "Successfully cancel");
        }catch (\Exception $e){
            session()->flash('bad', "Failed to delete");
        }
    }

    public function super_admin_Switch(){
        $data = SuperadminShow::all();
        if (count($data) == 1) {
            if ($this->superAdminSwitch == false) {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = false;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "disabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            } else {
                foreach ($data as $datas) {
                    $datas->user_id = auth()->user()->id;
                    $datas->on_off = true;
                    $datas->save();
                }
                $an = SuperadminShow::all();
                foreach ($an as $ans) {
                    $this->superAdminSwitch = $ans->on_off;
                }
                \App\Models\Logs::create([
                    'action' => "enabled super admin registration",
                    'user_id' => $this->user_id,
                    'photo' => $this->photo,
                    'fullname' => $this->fullname,
                ]);
            }
        }
    }

    public function click_items($id){
        $gh = \App\Models\Inventory::find($id);
        $this->device_name = $gh->name;
        $this->brand_name = $gh->brand_name;
        $this->quantity = $gh->quantity;
        $this->serial = $gh->serial;
        $this->inventory_id = $id;
        $this->results = [];
    }

    public function submitAdd(){
        $fg = \App\Models\Inventory::where('serial',$this->serial)
            ->where('status','stocked')->get();
        if (count($fg) == 0){
            session()->flash('notExist', "Serial number does not exist");
            return;
        }
        else{
            $yu = \App\Models\Inventory::where('serial',$this->serial)->get();
            if (count($yu) != 0){
                try {
                    \App\Models\MyDevice::create([
                        'name' => $this->device_name,
                        'serial' => $this->serial,
                        'quantity' => $this->quantity,
                        'status' => "for approval",
                        'brand_name' => $this->brand_name,
                        'fullname' => $this->fullname,
                        'inventory_id' => $this->inventory_id,
                        'user_id' => $this->user_id,
                    ]);
                    $aa = \App\Models\Inventory::find($this->inventory_id);
                    $aa->status = "for approval";
                    $aa->save();
                    $this->device_name = "";
                    $this->serial = "";
                    $this->quantity = "";
                    $this->brand_name = "";
                    session()->flash('good', "Successfully saved");
                }catch (\Exception $e){
                    session()->flash('bad', "Failed to save");
                }

            }
            else{
                session()->flash('bad', "Failed to save");
                return;
            }
        }
    }

    public function return($id){
        $this->ids = $id;
        $tu = \App\Models\MyDevice::find($id);
        $this->srl = $tu->serial;
    }

    public function returnItem(){
        try {
            $tr = \App\Models\MyDevice::find($this->ids);
            $tr->status = "return approval";
            $tr->save();

            $ts = \App\Models\MyDevice::find($this->ids);
            $hh = \App\Models\Inventory::find($ts->inventory_id);
            $hh->status = "for approval";
            $hh->save();
            session()->flash('goodReturn', "for approval");
        }catch (\Exception $e){
            session()->flash('badReturn', "Failed to return");
        }
    }

    public function updated($field){
        if ($field == "serial"){
            if ($this->serial != ""){
                $this->results = \App\Models\Inventory::where('serial','LIKE','%'. $this->serial. '%')
                    ->where('status','stocked')->get();
                $this->showSearch = true;
            }
            else{
                $this->showSearch = false;
                $this->results = [];
            }

        }
        if ($field == "registrationSwitch"){
            $this->regSwitch();
        }
        if ($field == "adminSwitch"){
            $this->admin_Switch();
        }
        if ($field == "superAdminSwitch"){
            $this->super_admin_Switch();
        }
        if ($field == "photo"){
            $filename = Str::random(40) . '.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('photos', $filename, 'public_photos');
            $user = User::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            $user = User::find($this->user_id)->comment;
            foreach ($user as $usr){
                $jn = Comment::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->comment_heart;
            foreach ($user as $usr){
                $jn = CommentHeart::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr;
            foreach ($user as $usr){
                $jn =Dtr::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->dtr_content;
            foreach ($user as $usr){
                $jn =DtrContent::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->log;
            foreach ($user as $usr){
                $jn =\App\Models\Logs::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->note;
            foreach ($user as $usr){
                $jn = Note::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = User::find($this->user_id)->time_setting;
            foreach ($user as $usr){
                $jn = TimeSetting::find($usr->id);
                $jn->photo = $filename;
                $jn->save();
            }
            $user = UserPassword::find($this->user_id);
            $user->photo = $filename;
            $user->save();
            return redirect('/itts/5/dashboard');
        }
    }
}
