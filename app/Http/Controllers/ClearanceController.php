<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MyDevice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    public function pdf($userID){
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
