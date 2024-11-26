<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
//use Hash;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $newuser = $request ->validated();
        
        $newuser['password'] = Hash::make($newuser['password']);

        $user = User::create($newuser);
        $success['token'] = $user->createToken('user',['app:all'])->plainTextToken;
        $success['username'] = $user ->username;
        $success['success'] = true;
        return response()->json($success, 200);

    }
    
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     // Attempt to authenticate using the provided credentials
    //     if (auth()->attempt($credentials)) {
    //         $user = auth()->user();

    //         // Generate token for authenticated user
    //         $success['token'] = $user->createToken('user', ['app:all'])->plainTextToken;
    //         $success['username'] = $user->username;
    //         $success['success'] = true;

    //         return response()->json($success, 200);
    //     }

    //     return response()->json(['error' => 'Unauthorized', 'success' => false], 401);
    // }
    
    public function showregisterForm()
{
    //return " finally This is the register page"; // Temporary message to verify the method works
    return User::all();
   }
}

