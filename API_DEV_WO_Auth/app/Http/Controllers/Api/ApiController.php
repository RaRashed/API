<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //Create API
    public function createEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:employees',
            'phone' =>'required',
            'gender' =>'required',
            'age' =>'required'

        ]);
        $emp = new Employee();
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gender;
        $emp->age = $request->age;

        $emp->save();
        return response()->json([

            "status" =>1,
            "message" => "Employee created Successfully"
        ]);


    }

     //List API
     public function listEmployees()
     {
         $employees=Employee::all();
         return response()->json([
             "status" => 1,
             "message" => "Listing Employees",
             "data" => $employees
         ],200);


     }

      //Single Detail API
    public function getSingleEmployee($id)
    {
      $emp=Employee::find($id);
      return response()->json([
        "status" => 1,
        "message" => "Single  Employe",
        "data" => $emp
    ]);


    }

     //update API
     public function updateEmployee(Request $request,$id)
     {
        $request->validate([
            'name' => 'required',
            'email' =>'required|email|unique:employees',
            'phone' =>'required',
            'gender' =>'required',
            'age' =>'required'

        ]);
        $emp = Employee::find($id);
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gender;
        $emp->age = $request->age;

        $emp->update();
        return response()->json([

            "status" =>1,
            "message" => "Employee Updated Successfully"
        ]);

     }

      //delete API
    public function deleteEmployee($id)
    {
        $emp=Employee::find($id);
        $emp->delete();
        return response()->json([

            "status" =>1,
            "message" => "Employee Deleted Successfully"
        ]);

    }

}
