<?php

namespace App\Http\Controllers;

use App\Models\DtrContent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EodController extends Controller
{
    public function pdf($user_id,$week){
        $dtrData = DtrContent::where('user_id',$user_id)
            ->where('week',$week)->get();
        $pdf = PDF::loadView('form.stockcard', compact('stockcard_data','item','stockNum'))
            ->setPaper('legal','portrait');
        return $pdf->stream('load.pdf');
    }
}
