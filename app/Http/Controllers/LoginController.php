<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function auth(Request $request){
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to intended location
            return redirect('/'); // Change to your dashboard route
        }
        else{
            return redirect('/user/login')->withErrors(['loginError' => 'Incorrect email or password!']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('/user/login');
    }

}
