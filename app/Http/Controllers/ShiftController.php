<?php

namespace App\Http\Controllers;

use App\Models\DtrContent;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function pdf($month, $day, $year){
        $dtrData = DtrContent::all();
        $pdf = PDF::loadView('form.shift', compact('dtrData','month','day','year'))
            ->setPaper('legal','landscape');
        return $pdf->download('load.pdf');
    }
}
