<?php

namespace App\Livewire;

use App\Models\AdminShow;
use App\Models\Comment;
use App\Models\CommentHeart;
use App\Models\Dtr;
use App\Models\DtrContent;
use App\Models\Employee;
use App\Models\IsRegistration;
use App\Models\MyNote;
use App\Models\Note;
use App\Models\SuperadminShow;
use App\Models\TimeSetting;
use App\Models\User;
use App\Models\UserPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class DeployedItemRecord extends Component
{
    public $registrationSwitch, $serial, $inventory_id, $brand_name, $quantity, $device_name, $employeeData, $ids, $srl, $showSearch = false, $status = "all", $deviceData, $deviceUserFullname, $deviceUserID, $position, $superAdminSwitch, $adminSwitch, $webName, $fullname, $user_id, $is_admin, $photo;
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
        if ($this->status == "all"){
            $this->deviceData = \App\Models\MyDevice::where('user_id',$this->deviceUserID)
                ->orderBy('created_at', 'desc')->get();
        }
        elseif ($this->status == "active"){
            $this->deviceData = \App\Models\MyDevice::where('user_id',$this->deviceUserID)
                ->where('status','deployed')
                ->orderBy('created_at', 'desc')->get();
        }
        elseif ($this->status == "returned"){
            $this->deviceData = \App\Models\MyDevice::where('user_id',$this->deviceUserID)
                ->where('status','returned')
                ->orderBy('created_at', 'desc')->get();
        }
        elseif ($this->status == "declined"){
            $this->deviceData = \App\Models\MyDevice::where('user_id',$this->deviceUserID)
                ->where('status','declined')
                ->orderBy('created_at', 'desc')->get();
        }
        $rh = Employee::where('user_id',$this->deviceUserID)->get();
        foreach ($rh as $hr){
            $this->deviceUserFullname = $hr->fname.' '.$hr->lname;
        }
        return view('livewire.deployed-item-all-record')->title('deployed device');
    }

//    public function submitAdd(){
//        $fg = \App\Models\inventory::where('serial',$this->serial)
//            ->where('status','stocked')->get();
//        if (count($fg) == 0){
//            session()->flash('notExist', "Serial number does not exist");
//            return;
//        }
//        else{
//            $yu = \App\Models\inventory::where('serial',$this->serial)->get();
//            if (count($yu) != 0){
//                try {
//                    \App\Models\MyDevice::create([
//                        'name' => $this->device_name,
//                        'serial' => $this->serial,
//                        'quantity' => $this->quantity,
//                        'status' => "for approval",
//                        'brand_name' => $this->brand_name,
//                        'fullname' => $this->fullname,
//                        'inventory_id' => $this->inventory_id,
//                        'user_id' => $this->user_id,
//                    ]);
//                    $aa = \App\Models\inventory::find($this->inventory_id);
//                    $aa->status = "for approval";
//                    $aa->save();
//                    $this->device_name = "";
//                    $this->serial = "";
//                    $this->quantity = "";
//                    $this->brand_name = "";
//                    session()->flash('good', "Successfully saved");
//                }catch (\Exception $e){
//                    session()->flash('bad', "Failed to save");
//                }
//
//            }
//            else{
//                session()->flash('bad', "Failed to save");
//                return;
//            }
//        }
//    }

//    public function cancelItemApproval(){
//        try {
//            $tr = \App\Models\MyDevice::find($this->ids);
//            $hh = \App\Models\inventory::find($tr->inventory_id);
//            $hh->status = "stocked";
//            $hh->save();
//            \App\Models\MyDevice::find($this->ids)->delete();
//            session()->flash('good', "Successfully cancel");
//        }catch (\Exception $e){
//            session()->flash('bad', "Failed to delete");
//        }
//    }

    public function returnItem(){
        try {
            $tr = \App\Models\MyDevice::find($this->ids);
            $tr->status = "returned";
            $tr->save();

            $ts = \App\Models\MyDevice::find($this->ids);
            $hh = \App\Models\Inventory::find($ts->inventory_id);
            $hh->status = "stocked";
            $hh->save();
            session()->flash('goodReturn', "for approval");
        }catch (\Exception $e){
            session()->flash('badReturn', "Failed to return");
        }
    }

//    public function cancelApproval($id){
//        $this->ids = $id;
//        $tu = \App\Models\MyDevice::find($id);
//        $this->srl = $tu->serial;
//    }

    public function return($id){
        $this->ids = $id;
        $tu = \App\Models\MyDevice::find($id);
        $this->srl = $tu->serial;
    }

    public function clickClearance($usrid){
        $yi = \App\Models\MyDevice::where('user_id',$usrid)->get();
        foreach ($yi as $yu){
            if ($yu->status == "deployed"){
                $this->dispatch('hasActive');
                return;
            }
        }
        return redirect()->to('/inventory/pdf/device-clearance/'.$usrid);
    }

    public function clickName($userids){
        return redirect()->to('itts/21/deployed-item-all-record/'.$userids);
    }
    public function mount($emp_id){
        $this->deviceUserID = $emp_id;
        $usrId = auth()->user()->id;
    }
    public function logout(){
        Auth::logout();
        return redirect()->to('/login');
    }

    public function updated($field){

    }
}
