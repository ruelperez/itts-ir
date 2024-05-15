<?php

namespace App\Http\Controllers;

use App\Models\DtrContent;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function pdf($month, $day, $year, $role){
        $dtrData = DtrContent::all();
        if ($role == "all"){
            $userID = [];
        }
        elseif ($role == "agent"){
//            $userID = [];
//            $hg = DtrContent::all();
//            foreach ($hg as $gh){
//                $userID[] = $gh->user_id;
//            }
            $userID = User::where('position',"Agent")->get();

        }
        else{
            $userID = User::where('position','!=',"Agent")->get();
        }

        $pdf = PDF::loadView('form.shift', compact('dtrData','month','day','year','userID','role'))
            ->setPaper('legal','landscape');
        return $pdf->download('load.pdf');
    }
}
