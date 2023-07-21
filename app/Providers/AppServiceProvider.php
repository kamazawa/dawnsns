<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

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
         view()->composer('*', function ($view)
        {
            $view->with('follow', DB::table('follows')->where('follower', auth()->id())->count());
            $view->with('follower', DB::table('follows')->where('follow', auth()->id())->count());
        });
    }
}
