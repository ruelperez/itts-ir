<?php

namespace App\Http\Controllers\AdminAccess;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
//    public function page($page){
//        $emp = [];
//        $employeeData = "";
//        $views = resource_path() . "/views/pages/admin-access/index.blade.php";
//        $fullname = auth()->user()->fullname;
//        $user_id = auth()->user()->id;
//        $position = auth()->user()->position;
//        $jj = Employee::where('user_id',$user_id)->get();
//        foreach ($jj as $yy){
//            $emp = Employee::find($yy->id);
//            $employeeData = $emp->designation;
//        }
//        $photo = auth()->user()->photo;
//        if (file_exists($views)) {
//            $title = Str::title($page);
//            return view("pages.admin-access.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname,
//                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
//        } else {
//            abort(404);
//        }
//    }

    public function page($folder,$page){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/admin-access/index.blade.php";
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
            return view("pages.admin-access.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'folder' => $folder, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

    public function salary($folder,$page,$id){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/admin-access/agent-salary/index.blade.php";
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
            return view("pages.admin-access.agent-salary.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'folder' => $folder, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'id' => $id, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

    public function eod($page){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/admin-access/eod/index.blade.php";
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
            return view("pages.admin-access.eod.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

    public function leadTracker($page){
        $emp = [];
        $employeeData = "";
        $views = resource_path() . "/views/pages/admin-access/lead-tracker/eod/index.blade.php";
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
            return view("pages.admin-access.lead-tracker.eod.index", ['title' => Str::replace('-', ' ', $title), 'page' => $page, 'fullname' => $fullname,
                'user_id' => $user_id, 'position' => $position, 'employeeData' => $employeeData, 'photo' => $photo, 'jj' => $jj, 'emp' => $emp, 'webName' => $page]);
        } else {
            abort(404);
        }
    }

}
