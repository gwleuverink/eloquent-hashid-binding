<?php

namespace Leuverink\HashidBinding\Tests;

use Leuverink\HashidBinding\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
