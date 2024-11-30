<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;

class LoginController extends Controller
{
    
    public function login(LoginRequest $request)
    {
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        try {
            
            if ($token = JWTAuth::attempt($credentials)) {
              
                $user = Auth::user();

               
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'name' => $user->username,
                ], 200);
            }

        } catch (JWTException $e) {
           
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

       
        return response()->json(['error' => 'invalid_credentials'], 401);
    }

   
    public function showLoginForm()
    {
       
        return response()->json(['message' => 'something is get it']);
    }
}