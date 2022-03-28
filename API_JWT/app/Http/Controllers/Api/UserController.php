<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required|unique:users',
            'phone' =>'required',
            'password'=>'required|confirmed'

        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password= bcrypt($request->password);
        $user->save();
        return response()->json([
            'status' =>1,
            "message" =>"User CReated Successfully"

        ],200);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if(!$token=auth()->attempt(['email' => $request->email, 'password' =>$request->password]))
        {
            return response()->json([
                'status' => 0,
                'message' =>"Invalid"
            ]);
        }
            return response()->json([
                'status' => 1,
                'message' =>"User Logged Successfully",
                'access_token' => $token
            ]);


    }

    public function profile()
    {
        $user_data = auth()->user();
        return response()->json([
            'status' =>1,
            'message' =>'USer Profile Data',
            'data' => $user_data

        ]);

    }


    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
