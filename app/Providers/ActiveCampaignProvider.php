<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ActiveCampaignProvider extends ServiceProvider
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
        $this->app->singleton('ActiveCampaign',  function($app) {
            $config = $app['config']['services']['activecampaign'];
            return new \ActiveCampaign($config['url'], $config['key']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [\ActiveCampaign::class];
    }
}
