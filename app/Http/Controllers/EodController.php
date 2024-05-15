<?php

namespace App\Http\Controllers;

use App\Models\DtrContent;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EodController extends Controller
{
    public function pdf($user_id,$week){
        $dtrData = DtrContent::where('user_id',$user_id)
            ->where('week',$week)->get();
       $userData = User::find($user_id);
        $pdf = PDF::loadView('form.eod', compact('dtrData','userData'))
            ->setPaper('legal','landscape');
        return $pdf->stream('load.pdf');
    }
}
