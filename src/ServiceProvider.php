<?php
namespace Leuverink\HashidBinding;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Hashids\Hashids;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/hashid-binding.php', 'lockdown');

        // Register implementations
        $this->app->singleton(HashidService::class, function ($app) {
            $appKey = $app->config->get('app.key'); // TODO: Add feature to overwrite the key using environment file
            $padding = 5; // TODO: Add feature to overwrite the padding using environment file

            return new HashidService(new Hashids($appKey, $padding));
        });
    }
}
