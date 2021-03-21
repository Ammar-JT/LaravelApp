<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//you need this for pagination in bootstrap
use Illuminate\Pagination\Paginator;


//--------------
//we add this to prevent the error of the migration command:
//use Illuminate\Support\Faceds\Schema;
//--------------

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //--------------------------------
        //Schema::defaultStringLength(191);
        //--------------------------------

        //you need this for pagination in bootstrap
        Paginator::useBootstrap();
    }
}
