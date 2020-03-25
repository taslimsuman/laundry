<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SponsorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeSponsor();
        $this->bottomSponsor();
        
    }

    public function composeSponsor(){
        view()->composer('layout.sponsor','App\Http\Composers\SponsorComposer');
    }

    public function bottomSponsor(){
        view()->composer('layout.banner','App\Http\Composers\SponsorComposer');
    }


   
}
