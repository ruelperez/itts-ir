<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\DtrContent;
use App\Models\User;
use App\Models\UserAccess;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DailyShiftController extends Controller
{
    public function pdf($month, $day, $year, $role){
        $dtrData = DtrContent::all();
        if ($role == "all"){
            $userID = [];
        }
        elseif ($role == "task executor"){
            $gn = [];
            $jn = UserAccess::where('dtr_task', 1)->get();
            foreach ($jn as $jj){
                $gn[] = User::find($jj->user_id);
            }
            $userID = $gn;
        }
        else{
            $userID = User::where('position',$role)->get();
        }

        $pdf = PDF::loadView('form.shift', compact('dtrData','month','day','year','userID','role'))
            ->setPaper('legal','landscape');
        return $pdf->stream('load.pdf');
    }
}
