<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
     //Register API
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required',
             'email' =>'required|email|unique:students',
             'password' =>'required|confirmed'
         ]);

         $emp = new Student();
         $emp->name = $request->name;
         $emp->email = $request->email;
         $emp->password = Hash::make($request->password);
         $emp->phone = isset($request->phone) ? $request->phone:"";



         $emp->save();
         return response()->json([

             "status" =>1,
             "message" => "STD created Successfully"
         ]);


     }
//LOgin API
     public function login(Request $request)
     {
        $request->validate([

            'email' =>'required',
            'password' =>'required'
            ]);
            $student = Student::where("email","=", $request->email)->first();
            if(isset($student->id))
            {
                if(Hash::check($request->password,$student->password))
                {
                    $token=$student->createToken("auth_token")->plainTextToken;

                    return response()->json([
                        "status"=>1,
                        "message" =>"Student Logged in Successfully",
                        "access_token" =>$token

                    ]);
                }
                else{
                    return response()->json([
                        "status" =>0,
                        "message" =>"Password didn't match"
                    ],404);

                }

            }
            else{
               return response()->json([
                   "status" =>0,
                   "mesage" =>"Student not found"
               ],404);

            }

     }
     //Profile API
     public function profile()
     {
        return response()->json([
            "status" =>1,
            "mesage" =>"Student information",
            "data" =>auth()->user()
        ]);

     }
     //LOgout API
     public function logout()
     {

     }
}
