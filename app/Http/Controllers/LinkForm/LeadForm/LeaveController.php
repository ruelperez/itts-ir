<?php

namespace App\Http\Controllers\LinkForm\LeadForm;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeaveController extends Controller
{
    public function page($page){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/link-form/leave-form/index.blade.php";
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
            $title = Str::title($page);
            return view("pages.link-form.leave-form.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }
}
