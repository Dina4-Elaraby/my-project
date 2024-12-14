<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
//use Illuminate\Foundation\Support\Providers\AppServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;




class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        Schema::defaultStringLength(191);
       
    }

    
}
