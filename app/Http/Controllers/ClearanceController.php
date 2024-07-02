<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ClearanceController extends Controller
{
    public function pdf($userID){
dd($userID);
        $pdf = PDF::loadView('form.device-clearance', compact('dtrData','userData'))
            ->setPaper('legal','landscape');
        return $pdf->download('load.pdf');
    }
}
