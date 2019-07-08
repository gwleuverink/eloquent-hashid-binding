<?php

namespace Leuverink\HashidBinding;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Hashids\Hashids;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
             __DIR__ . '/../config/hashid-binding.php' => base_path('config/hashid-binding.php'),
        ], 'hashid-binding');
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(__DIR__ . '/../config/hashid-binding.php', 'hashid-binding');

        // Register implementations
        $this->app->singleton(HashidService::class, function ($app) {
            $salt = $app->config->get('hashid-binding.salt');
            $padding = $app->config->get('hashid-binding.length');

            return new HashidService(new Hashids($salt, $padding));
        });
    }
}
