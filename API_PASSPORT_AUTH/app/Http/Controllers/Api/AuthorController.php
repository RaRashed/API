<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index()
    {
        return view('create');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:authors',
            'password' => 'required',
            'phone' => 'required'

        ]);
        $author = new Author();
        //dd(request()->all());
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = bcrypt($request->password);
        $author->phone = $request->phone;


        $author->save();
        return redirect(url('api/create'));


    }
    public function login(Request $request)
    {
        $login_data = $request->validate([

            'email' => 'required',
            'password' => 'required'


        ]);
        if(!auth()->attempt($login_data))
        {
            return response()->json([
                'status' => false,
                'message' =>'invalid'

            ]);


        }
        else{
            $token = auth()->user()->createToken("auth_token")->accessToken;
            return response()->json([
                'status' => true,
                'message' => "Author Logged in",
                'access_token' => $token

            ]);

        }



    }
    public function profile()
    {
        $data = auth()->user();
        return response()->json([
            'status' => true,
            'message' => "Author Data",
            'access_token' => $data

        ]);

    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }
}
