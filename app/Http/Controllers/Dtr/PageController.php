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
                $this->in();
                $dtrData = DtrPermanent::latest('updated_at')->get();
                return response()->json(['success' => true, 'dtrData' => $dtrData]);
            }
            elseif ($this->dtr_data->out == "" or $this->dtr_data->out == null){
                $this->out();
                $dtrData = DtrPermanent::latest('updated_at')->get();
                return response()->json(['success' => true, 'dtrData' => $dtrData]);
            }
            elseif ($this->dtr_data->in2 == "" or $this->dtr_data->in2 == null){
                $this->in2();
                $dtrData = DtrPermanent::latest('updated_at')->get();
                return response()->json(['success' => true, 'dtrData' => $dtrData]);
            }
            elseif ($this->dtr_data->out2 == "" or $this->dtr_data->out2 == null){
                $this->out2();
                $dtrData = DtrPermanent::latest('updated_at')->get();
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

    public function in(){
        Dtr::create([
            'fullname' => $this->userData->fullname,
            'in' => Carbon::now(),
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
            'user_id' => $this->userData->id,
            'dtr_id' => $id,
            'photo' => $this->userData->photo,
            'branch' => $this->userData->branch,
        ]);
    }

    public function out(){
        $gf = Dtr::find($this->dtr_data->id);
        $gf->out = Carbon::now();
        $gf->save();

        $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
        foreach ($gs as $gg){
            $gg->out = Carbon::now();
            $gg->save();
        }
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
    }

    public function out2(){
        $gf = Dtr::find($this->dtr_data->id);
        $gf->out2 = Carbon::now();
        $gf->save();

        $gs = Dtr::find($this->dtr_data->id)->dtr_permanent;
        foreach ($gs as $gg){
            $gg->out2 = Carbon::now();
            $gg->save();
        }
    }

    public function scan(){
        $fe = User::find(auth()->user()->id)->user_access->first();
        $authorizer = $fe->qr_scanner;
        if ($authorizer){

        }
        else{
            return redirect('/');
        }
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
        $dtrData = DtrPermanent::latest('updated_at')->get();
        $ngg = DtrPermanent::latest('updated_at')->first();
        if (!$ngg){
            $empPhoto = "default_profile.png";
            $empFullname = "Full Name";
        }
        else{
            $empPhoto = $ngg->photo;
            $empFullname = $ngg->fullname;
        }

        if (file_exists($views)) {
            $title = Str::title('qr-reader ');
            return view("employee.qr-reader", ['title' => Str::replace('-', ' ', $title), 'dtrData' => $dtrData, 'empPhoto' => $empPhoto, 'empFullname' => $empFullname, 'fullname' => $fullname,
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
