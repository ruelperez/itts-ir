<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function page($page){
        $views = resource_path() . "/views/user/pages/$page.blade.php";
        if (file_exists($views)) {
            $title = Str::title($page);
            return view("user.pages.$page", ['title' => Str::replace('-', ' ', $title)]);
        } else {
            abort(404);
        }
    }
}
