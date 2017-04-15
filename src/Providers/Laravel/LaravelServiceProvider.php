<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Providers\Laravel;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use Rugaard\StatsFC\StatsFC;

/**
 * Class LaravelServiceProvider.
 *
 * @package Rugaard\StatsFC\Providers\Laravel
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Service Provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot service provider.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file.
        $this->publishes([__DIR__ . '/config.php' => config_path('statsfc.php')], 'config');
    }

    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rugaard.statsfc', function ($app) {
            return (new StatsFC(config('statsfc.apiKey')))
                   ->setBaseUrl(config('statsfc.baseUrl'))
                   ->setVersion(config('statsfc.version'));
        });

        $this->app->bind('Rugaard\StatsFC\StatsFC', function ($app) {
            return $app['rugaard.statsfc'];
        });
    }

    /**
     * Get the services provided by this provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rugaard.statsfc'];
    }
}