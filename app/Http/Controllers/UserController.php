<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(Request $request){

        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed",
            "phone_number"=>"required",
            "image"=>"required"
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $image->move($destinationpath , $name);
        $user->image = $name;

        $user->password = bcrypt($request->password);
        $user->save();
        
        $token = $user->createToken("auth_token")->accessToken;
        $response['access_token'] = $token;
        $response['message'] = "User Creted Successfully";
       return  response()->json($response,200);

    }

public function login(Request $request){
        
    $login_data = $request->validate([
        "email"=>"required",
        "password"=>"required"
    ]);


    if(!auth()->attempt($login_data)){
        $response['message'] = "Wrong Information";
       return  response()->json($response,404);
    }
    
    $token = auth()->user()->createToken("auth_token")->accessToken;
    $response['message'] = "Logeed in successfuly";
    $response['access_token'] = $token;
    return  response()->json($response,200);
    
    
    }

    public function profile(){
        $user_data = auth()->user();
    $response['message'] = "user data";
    $response['data'] = $user_data;
    return  response()->json($response,200);
    }

    public function logout(Request $request){
        $token = $request->user()->token();
        $token->revoke();
        $response['message'] = "Logged Out Successfuly";
    return  response()->json($response,200);
    }
}
