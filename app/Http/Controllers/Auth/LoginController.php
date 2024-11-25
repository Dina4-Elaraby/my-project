<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
    //get data
    $credentials = 
    [
        'email' => $request->email,
        'password' => $request->password,
    ];
    //check
    if(Auth::attempt(['email' => $request-> email , 'password' => $request-> password]))
    {
        // $user = Auth::username();
        // $user ->tokens()->delete();
        // $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;
        // $success['username'] = $user->username;
        // $success['success'] = true;
        // return response()->json($success,200);
        //return redirect()->intended('dashboard');
        return response()->json(['message' => 'Login successful']);

    }
    else
    {
        return response()->json(['error'=>'unautherised'],401);
    }
    }
}

