<?php

namespace CraftedSystems\Advanta;

use Illuminate\Support\ServiceProvider;

class AdvantaSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/Config/advanta.php' => config_path('advanta.php'),
        ], 'advanta_config');

        $this->app->singleton(AdvantaSMS::class, function () {
            return new AdvantaSMS(config('advanta'));
        });

        $this->app->alias(AdvantaSMS::class, 'advanta-sms');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/advanta.php', 'advanta-sms'
        );
    }
}
