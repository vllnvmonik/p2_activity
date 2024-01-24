<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;


use App\Models\User;


class AuthApiController extends Controller
{
    public function registration(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->fails()){
            return response() -> json([
                'message'=>'Registration failed',
                'errors' => $validator->errors()
            ],422);
        }
        
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),

        ]);

        return response() -> json([
            'message'=>'Registration successful',
            'data' => $user
        ],200);

    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return response() -> json([
                'message'=>'Login failed',
                'errors' => $validator->errors()
            ],422);
        }

        $user = User::where('email', $request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $token=$user->createToken("auth-token")->plainTextToken;
                return response() -> json([
                    'message'=>'Login successful',
                    'token'=>$token,
                    'data'=>$user
                ],200);
            }else{
                return response() -> json([
                    'message'=>'Invalid Credential'
                ],400);
            }
        }else{
            return response() -> json([
                'message'=>'Invalid Credential'
            ],400);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }


    public function resetPassword(){
        
    }
}
