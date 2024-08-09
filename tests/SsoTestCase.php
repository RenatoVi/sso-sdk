<?php

namespace Sso\SsoSdk\Tests;

use Orchestra\Testbench\TestCase;
use Sso\SsoSdk\Providers\SsoServiceProvider;

class SsoTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            SsoServiceProvider::class,
        ];
    }
}