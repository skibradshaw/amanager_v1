<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load Undeposited Payments to Nav Bar
        view()->composer('inc.header',function($view){
            $view->with('undepositedfunds',\App\Payment::whereRaw('bank_deposits_id IS NULL')->get()->sum('amount'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment('local')) {
            $this->app->register('Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider');
            $this->app->register('Way\Generators\GeneratorsServiceProvider');
        }		
		       
    }
}
