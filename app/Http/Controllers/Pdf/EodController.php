<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\DtrContent;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class EodController extends Controller
{
    public function pdf($user_id,$year,$month,$week){
        if ($week == "all"){
            $dtrData = DtrContent::where('user_id',$user_id)
                ->whereYear('in', $year)
                ->whereMonth('in', $month)
                ->get();
        }
        else{
            $dtrData = DtrContent::where('user_id',$user_id)
                ->whereYear('in', $year)
                ->whereMonth('in', $month)
                ->where('week',$week)
                ->get();
        }

       $jj = Employee::where('user_id',$user_id)->get();
       foreach ($jj as $yy){
           $userData = Employee::find($yy->id);
       }
        $pdf = PDF::loadView('form.eod', compact('dtrData','userData'))
            ->setPaper('legal','landscape');
        return $pdf->stream('load.pdf');
    }
}
