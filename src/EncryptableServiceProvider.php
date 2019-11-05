<?php

namespace Encryption\src;

use Illuminate\Support\ServiceProvider;

class EncryptableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../src/config/encryption.php' => config_path('encryption.php'),
        ]);
    }
}
