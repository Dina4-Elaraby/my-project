<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



// Example route for dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Make sure you have a view called 'dashboard.blade.php'
})->name('dashboard');
