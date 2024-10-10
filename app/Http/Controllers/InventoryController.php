<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MyDevice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    public function page($page,$emp_id)
    {
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/inventory/index.blade.php";
        $fullname = auth()->user()->fullname;
        $user_id = auth()->user()->id;
        $position = auth()->user()->position;
        $jj = Employee::where('user_id', $user_id)->get();
        foreach ($jj as $yy) {
            $emp = Employee::find($yy->id);
            $employeeData = $emp->designation;
        }
        $photo = auth()->user()->photo;
        if (file_exists($views)) {
            $title = Str::title($page);
            return view("pages.inventory.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname, 'emp_id' => $emp_id,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

    public function clearance($userID){
        $qw = ['laptop','mouse','headset','keyboard','charger','desktop','monitor','usb adapter'];
        $pp = [];
        $userInfo = [];
        $deviceData = [];
        for ($i=0; $i<count($qw); $i++){
            $uu = MyDevice::where('user_id',$userID)
                ->where('name',$qw[$i])->latest()->first();
            if ($uu != null or $uu != ""){
                $pp[] = $uu->id;
            }
        }
        for ($i=0; $i<count($pp); $i++){
            $deviceData[] = MyDevice::find($pp[$i]);
        }

        $ui = Employee::where('user_id',$userID)->get();
        foreach ($ui as $us){
            $userInfo = Employee::find($us->id);
        }
        $pdf = PDF::loadView('form.device-clearance', compact('deviceData','userInfo'))
            ->setPaper('legal','portrait');
        return $pdf->stream('load.pdf');
    }
}
