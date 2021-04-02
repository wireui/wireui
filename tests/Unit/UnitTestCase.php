<?php

namespace Tests\Unit;

use Orchestra\Testbench\TestCase;
use WireUi\Providers\WireUiServiceProvider;

class UnitTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [WireUiServiceProvider::class];
    }
}
