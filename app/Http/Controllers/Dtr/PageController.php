<?php

namespace App\Http\Controllers\Dtr;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PageController extends Controller
{
    public function generateQrCode($employeeId)
    {
        $qrCode = QrCode::size(200)->generate($employeeId);
        return view('employee.qrcode', compact('qrCode', 'employeeId'));
    }

    public function verifyQrCode(Request $request)
    {
        $employee = Employee::where('id_user', $request->qrCode)->first();

        if ($employee) {
            // Record the time in
            // You can add time-out logic here if needed

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function scan(){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/employee/qr-reader.blade.php";
        $fullname = auth()->user()->fullname;
        $user_id = auth()->user()->id;
        $position = auth()->user()->position;
        $jj = Employee::where('user_id',$user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $employeeData = $emp->designation;
        }
        $photo = auth()->user()->photo;
        if (file_exists($views)) {
            $title = Str::title('qr-reader ');
            return view("employee.qr-reader", ['title' => Str::replace('-', ' ', $title), 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp]);
        } else {
            abort(404);
        }
    }
    public function page($page){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/dtr-all-record/index.blade.php";
        $fullname = auth()->user()->fullname;
        $user_id = auth()->user()->id;
        $position = auth()->user()->position;
        $jj = Employee::where('user_id',$user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $employeeData = $emp->designation;
        }
        $photo = auth()->user()->photo;
        if (file_exists($views)) {
            $title = Str::title('eod '.$page);
            return view("pages.dtr-all-record.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

    public function employee($page,$emp_id){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/dtr-all-record/byname/index.blade.php";
        $fullname = auth()->user()->fullname;
        $user_id = auth()->user()->id;
        $position = auth()->user()->position;
        $jj = Employee::where('user_id',$user_id)->get();
        foreach ($jj as $yy){
            $emp = Employee::find($yy->id);
            $employeeData = $emp->designation;
        }
        $photo = auth()->user()->photo;
        if (file_exists($views)) {
            $title = Str::title('eod '.$page);
            return view("pages.dtr-all-record.byname.index", ['title' => Str::replace('-', ' ', $title), 'emp_id' => $emp_id, 'page' => $page, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }
}
