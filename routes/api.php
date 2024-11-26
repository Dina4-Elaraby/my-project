<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $request->validate([
        'token_username' => 'required|string|max:255',
    ]);

    $token = $request->user()->createToken($request->token_username);

    return ['token' => $token->plainTextToken];


    Route::middleware('mymiddleware')->get('/example', function () 
    {
        return 'This route uses MyMiddleware!';
    });


    

});

Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[loginController::class, 'login']);

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::get('/register', [registerController::class, 'showregisterForm']);





Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();
});

