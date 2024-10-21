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
            $jj = auth()->user()->id;
            $dada = User::find($jj)->user_access->first();
            if ($dada->can_login){
                return redirect('/');
            }
            Auth::logout();
            return redirect('/user/login')->withErrors(['loginError' => 'You are no longer authorized to login, Please coordinate to admin user!']);
        }
        else{
            return redirect('/user/login')->withErrors(['loginError' => 'Incorrect email or password!']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->to('/user/login');
    }

    public function special(Request $request){
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $jj = auth()->user()->id;
            $dada = User::find($jj)->user_access->first();
            if ($dada->login_special){
                return redirect('/');
            }
            Auth::logout();
            return redirect('/login/special')->withErrors(['loginError' => 'Not a special account!']);
        }
        else{
            return redirect('/login/special')->withErrors(['loginError' => 'Incorrect email or password!']);
        }
    }

}
