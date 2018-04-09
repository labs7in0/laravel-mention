<?php

namespace Labs7in0\Mention;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Application bootstrap event.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/mention.php' => config_path('mention.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        //
    }
}
