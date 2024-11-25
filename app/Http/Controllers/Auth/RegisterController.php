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
}
