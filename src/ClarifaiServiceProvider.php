<?php

namespace Threeel\Clarifai;

use Illuminate\Support\ServiceProvider;

class ClarifaiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/clarifai.php' => config_path('clarifai.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/clarifai.php', 'clarifai');
        \App::bind('clarifai', function ($app) {
            $client = new ClarifaiClient();
            return new Clarifai($client);
        });
    }
}
