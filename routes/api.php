<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/user', function (Request $request) {
    return $request->username();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $request->validate([
        'token_name' => 'required|string|max:255',
    ]);

    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
    
    Route::middleware('mymiddleware')->get('/example', function () {
        return 'This route uses MyMiddleware!';
    });
});

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
// Route::get('register',[RegisterController::class,'register']);
// Route::get('login',[LoginController::class,'login']);