<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

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
        View::composer('*', function($view){

            $languages = [
                // [route, flag, label]
                ['en', 'gb', 'English'],
                // ['de', 'de', 'German'],
                ['hu', 'hu', 'Hungarian'],
            ];

            $view->with('languages', $languages);
        });
    }
}
