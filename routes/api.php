<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\TreatmentController;


use App\Models\Plant;

Route::post('/tokens/create', function (Request $request) 
{ 
    $request->validate([
        'token_username' => 'required|string|max:255',
    ]);

    $token = $request->user()->createToken($request->token_username);

    return ['token' => $token->plainTextToken];    
    

});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});




 
 


use App\Http\Controllers\DiseaseController;
Route::get('/diseases', [DiseaseController::class, 'index']);
Route::post('/diseases', [DiseaseController::class, 'store']);
Route::get('/diseases/{id}', [DiseaseController::class, 'searchById']);
Route::delete('diseases/{id}', [DiseaseController::class, 'destroy']);


Route::resource('treatments', TreatmentController::class)->except(['create' , 'edit']);
Route::resource('plants', PlantController::class)->except(['create' , 'edit']);

