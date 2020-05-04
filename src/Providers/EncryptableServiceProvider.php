<?php

namespace Kablanfatih\Encryption\Providers;

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
        $this->mergeConfigFrom(__DIR__ . '/../../config/encryption.php', 'encryption');
    }
}
