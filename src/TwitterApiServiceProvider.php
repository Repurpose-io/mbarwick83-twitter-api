<?php

namespace Mbarwick83\TwitterApi;

use Illuminate\Support\ServiceProvider;

class TwitterApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/TwitterApi.php' => config_path('twitter-api.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Mbarwick83\TwitterApi\TwitterApi',function($app){
            return new TwitterApi($app);
        });
    }
}
