<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\DtrContent;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DailyShiftController extends Controller
{
    public function pdf($month, $day, $year, $role){
        $dtrData = DtrContent::all();
        if ($role == "all"){
            $userID = [];
        }
        elseif ($role == "agent"){
            $userID = User::where('position',"Agent")->get();
        }
        else{
            $userID = User::where('position','!=',"Agent")->get();
        }

        $pdf = PDF::loadView('form.shift', compact('dtrData','month','day','year','userID','role'))
            ->setPaper('legal','landscape');
        return $pdf->stream('load.pdf');
    }
}
