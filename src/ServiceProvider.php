<?php
namespace Didiroesmana\LaravelCoinbase;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/config/coinbase.php';
        $this->mergeConfigFrom($configPath, 'coinbase');
        $this->app->singleton('Didiroesmana\LaravelCoinbase\Coinbase', function ($app) {
            $apiKey = config('coinbase.apiKey');
            $apiSecret = config('coinbase.apiSecret');
            return new Coinbase($apiKey, $apiSecret);
        });

        $this->app->alias('Didiroesmana\LaravelCoinbase\Coinbase', 'coinbase');
    }
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/coinbase.php' => config_path('coinbase.php'),
        ], 'coinbase');
    }
}