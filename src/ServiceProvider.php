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

        // Publish migrations for testing
        if ($this->app->environment('testing')) {
           
            $this->publishes([
                __DIR__ . '/../migrations/create_hashid_binding_test_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_hashid_binding_test_table.php'),
            ]);
        }
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
