<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('welcome'));
        }
        return view('login');
    }
    function registration(){
        if(Auth::check()){
            return redirect(route('welcome'));
        }
        return view('registration');
    }
    function welcome(){
        return view('welcome');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userCredential = $request -> only('email', 'password');

        if(Auth::attempt($userCredential)){
            return redirect()-> intended(route('welcome'));
        }
        return redirect(route('login'))-> with("invalid", "Invalid Credential");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $data['name'] = $request -> name;
        $data['email'] = $request -> email;
        $data['password'] = Hash::make($request -> password);

        $user = User::create($data);

        if(!$user){
            return redirect(route('registration'))-> with("invalid", "Invalid Credential");
        }
        return redirect(route('welcome'));
    }

    function logout(){
        Auth::logout();
        return redirect(route('login'));
    }
}
