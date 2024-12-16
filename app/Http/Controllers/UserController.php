<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function registerForm(){
        return view('main.signup');
    }
    public function loginForm(){
        return view('main.signin');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required | min:5',
            'email' => 'required | regex:/(.*)@gmail\.com/',
            'password' => 'required | min:8',
            'confirmpassword' => 'required |min:8'
        ]);

        if(User::where('email', $request->email)->first()){
            return back()->withErrors('Email already exist');
        }
        if($request->password != $request->confirmpassword){
            return back()->withErrors('The password didn\'t match');
        }

        User::create([
            'name'=>$request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')->with('success', 'user registered!');
    }

    public function login(Request $request){
        $user = User::where('email','=', $request->email)->first();
        // dd($request);
        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            if(Auth::check()){
                if(Auth::user()->isAdmin == '1'){
                    return redirect('/admin/dashboard');
                }else{
                    return redirect('/');
                }
            }else{
                return redirect('/login-form');
            }
        }else{
            return back()->withErrors('The provided credentials do not match out records.');
        }
        return redirect('/');
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect('/login')->with('success', 'loged out successfully!');
    }
}
