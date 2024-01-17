<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;



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
        if(Auth::check()){
            return view('welcome');
        }else{
            return redirect(route('login'))->with("alert", "Please log in");
        }
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
        return redirect(route('login'))-> with("alert", "Invalid Credential");
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
            return redirect(route('registration'))-> with("alert", "Invalid Credential");
        }
        return redirect(route('welcome'));
    }

    function logout(){
        Auth::logout();
        return redirect(route('login'));
    }


    function forgetPassword(){
        return view("forget-password");
    }

    
    function forgetPasswordPost(Request $request){
        $request->validate([
            'email' => "required|email|exists:users",
        ]);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
        'email' => $request->email,
        'token' => $token,
        'created_at' => Carbon::now()
        ]);
        
        Mail::send("email.forget-password", ['token' => $token], function($message) use ($request){
            $message ->to($request->email);
            $message ->subject("Reset Password");

        });

        return redirect()-> to(route("forget.password"))-> with("alert", "Email has been sent to reset your password.");

    }

    function resetPassword($token){
        if(Auth::check()){
            return view("new-password", compact('token'));
        }else{
            return redirect(route('login'))->with("alert", "Please log in to access the password reset page.");
        }
    }

    function resetPasswordPost(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
        -> where([
            'email' => $request->email,
            'token' => $request -> token
        ])->first();

        if(!$updatePassword){
            return redirect()->to(route("reset.password"))-> with ("alert", "Invalid.");
        }

        User::where("email", $request->email)
            ->update(["password"=> Hash::make($request->password)]);

        DB::table('password_reset_tokens')-> where([
            'email' => $request->email])->delete();

        return redirect(route('login'))-> with("alert", "Password reset successful.");
        
    }
}
