<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LeaveFormController extends Controller
{
    public function pdf($id){
        $data = \App\Models\LeaveForm::find($id);
        $userID = $id;
        $ui = Employee::where('user_id',$userID)->get();
        foreach ($ui as $us){
            $userInfo = Employee::find($us->id);
        }
        $pdf = PDF::loadView('form.leave-form', compact('data'))
            ->setPaper('a4','portrait');
        return $pdf->stream('load.pdf');
    }
}
