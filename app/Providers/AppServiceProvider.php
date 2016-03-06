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
            $properties = \App\Property::all();
            $rents_due = 0;
            $deposits_due = 0;
            foreach ($properties as $p) {
                $rents_due += $p->rentBalance();
                $deposits_due += $p->depositBalance();
            }            
            
            $view->with('rents_due',$rents_due);
            $view->with('deposits_due',$deposits_due);
            $view->with('properties',$properties);

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
