<?php

namespace Tests;

use Kablanfatih\Encryption\Providers\EncryptableServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{

    protected function setUp() : void
    {
        parent::setUp();
        config(['encryption.encrypt' => true]);
        $this->withPackageMigrations();
        $this->getServiceProviderClass();
    }

    /**
     * Get the service provider class.
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        $this->app->register(EncryptableServiceProvider::class);
    }

    protected function withPackageMigrations()
    {
        include_once __DIR__.'/CreateTestModelTable.php';
        (new CreateTestModelTable())->up();
    }
}
