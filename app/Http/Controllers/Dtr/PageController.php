<?php

namespace App\Http\Controllers\Dtr;

use App\Http\Controllers\Controller;
use App\Models\Dtr;
use App\Models\DtrPermanent;
use App\Models\Employee;
use App\Models\TimeSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PageController extends Controller
{
    public $dtr_data, $userData; // A public property in a controller

    public function __construct()
    {
        $this->dtr_data = [];
        $this->userData = [];
    }
    public function generateQrCode($employeeId)
    {
        $qrCode = QrCode::size(250)->generate($employeeId);
        return view('employee.qrcode', compact('qrCode', 'employeeId'));
    }

    public function verifyQrCode(Request $request)
    {
        $employee = Employee::where('id_user', $request->qrCode)->first();
        $this->dtr_data = Dtr::where('user_id', $employee->user_id)->latest()->first();
        $this->userData = User::find($employee->user_id);
        if ($employee) {
            if ($this->dtr_data == null) {
                $this->in1();
                $dtrData = DtrPermanent::all();
                return response()->json(['success' => true, 'dtrData' => $dtrData]);
            }
            elseif ($this->dtr_data->in2 == "" or $this->dtr_data->in2 == null){
                $this->in2();
                $dtrData = DtrPermanent::all();
                return response()->json(['success' => true, 'dtrData' => $dtrData]);
            }
            else{
                return response()->json(['success' => false]);
            }
        }
        else{
            return response()->json(['success' => false]);
        }
    }

    public function in1(){
        $gn = TimeSetting::all();
        if (count($gn) == 0){
            TimeSetting::create([
                'in' => "10:00 pm",
                'out' => "01:00 am",
                'in2' => "02:00 am",
                'out2' => "07:00 am",
                'fullname' => "Ruel Perez",
                'user_id' => 1,
                'photo' => "default_profile.png",
            ]);
        }
        $gt = TimeSetting::all();
        foreach ($gt as $gs) {
            $end = $gs->out;
            $end2 = $gs->out2;
        }
        $rt = Carbon::now();
        $time1 = Carbon::parse($rt);
        $time2 = Carbon::parse($end);
        if ($time2->lessThan($time1)) {
            $time2->addDay(); // Add a day to the end time
        }
        $interval = $time1->diff($time2);
        Dtr::create([
            'fullname' => $this->userData->fullname,
            'in' => Carbon::now(),
            'out' => $end,
            'out2' => $end2,
            'user_id' => $this->userData->id,
            'photo' => $this->userData->photo,
            'branch' => $this->userData->branch,
        ]);
        $ss = Dtr::where('fullname', $this->userData->fullname)
            ->where('user_id', $this->userData->id)->get();
        foreach ($ss as $s) {
            $id = $s->id;
        }

        DtrPermanent::create([
            'fullname' => $this->userData->fullname,
            'in' => Carbon::now(),
            'out' => $end,
            'out2' => $end2,
            'user_id' => $this->userData->id,
            'dtr_id' => $id,
            'hour' => $interval->h,
            'minute' => $interval->i + 1,
            'photo' => $this->userData->photo,
            'branch' => $this->userData->branch,
        ]);
    }

    public function in2(){
        $gf = Dtr::find($this->dtr_data->id);
        $gf->in2 = Carbon::now();
        $gf->save();

        $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
        foreach ($gs as $gg){
            $gg->in2 = Carbon::now();
            $gg->save();
        }

        $lk = Dtr::find($this->dtr_data->id)->dtr_permanent;
        foreach ($lk as $gg){
            $pp = $gg->in;
            $kk = $gg->out;
            $rr = $gg->in2;
            $ss = $gg->out2;
        }
        $time1 = Carbon::parse($pp);
        $time2 = Carbon::parse($kk);
        if ($time2->lessThan($time1)) {
            $time2->addDay(); // Add a day to the end time
        }
        $interval1 = $time1->diff($time2);

        $time3 = Carbon::parse($rr);
        $time4 = Carbon::parse($ss);
        if ($time4->lessThan($time3)) {
            $time4->addDay(); // Add a day to the end time
        }
        $interval2 = $time3->diff($time4);

        $resultHour = intval($interval1->h) + intval($interval2->h);
        $resultMinute = intval($interval1->i) + intval($interval2->i);

        $gk = Dtr::find($this->dtr_data->id)->dtr_permanent;
        foreach ($gk as $gg){
            $gg->hour = $resultHour;
            $gg->minute = $resultMinute + 2;
            $gg->save();
        }

        $gf = Dtr::find($this->dtr_data->id);
        $gf->in2 = Carbon::now();
        $gf->save();
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
        $dtrData = DtrPermanent::all();
        if (file_exists($views)) {
            $title = Str::title('qr-reader ');
            return view("employee.qr-reader", ['title' => Str::replace('-', ' ', $title), 'dtrData' => $dtrData, 'fullname' => $fullname,
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
