<?php

namespace Leuverink\HashidBinding;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        // Publish config
        $this->publishes([
             __DIR__.'/../config/hashid-binding.php' => base_path('config/hashid-binding.php'),
        ], 'hashid-binding');
    }

    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(__DIR__.'/../config/hashid-binding.php', 'hashid-binding');

        // Register implementations
        $this->app->singleton(HashidService::class, function ($app) {
            $saltModifier = $app->config->get('hashid-binding.salt');
            $padding = $app->config->get('hashid-binding.length');

            $transcoder = new TranscoderFactory(Hashids::class, $saltModifier, $padding);

            return new HashidService($transcoder);
        });
    }
}
