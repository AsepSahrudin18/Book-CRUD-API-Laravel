<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
 * import models
 * import hash
 * import auth
 */
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // fungsi register
    public function register(Request $request){
        $input = [
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email
        ];

        $user = User::create($input);

        return response()->json([
            'status'=>'success',
            'message'=>'Register success!'
        ]);

    }

    // fungsi login
    public function login(Request $request) { 
        $input = [ 
            "email" => $request->email, 
            "password" => $request->password, 
        ]; 
        
        $user = User::where("email", $input["email"])->first(); 
        
        if (Auth::attempt($input)) { 
            $token = $user->createToken("token")->plainTextToken; 
            return response()->json([ 
                "code" => 200, 
                "status" => "success", 
                "message" => "Login success", 
                "token" => $token 
            ]); 
        } 
        else { 
            return response()->json([ 
                "code" => 401, 
                "status" => "error", 
                "message" => "Login failed" 
            ]); 
        } 
    }

    public function logout()
    {        
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout successfuly!'
        ]);
    }
}