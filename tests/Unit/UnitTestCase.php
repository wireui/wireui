<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase;
use WireUi\Providers\WireUiServiceProvider;

class UnitTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->group(base_path('src/routes/web.php'));
    }

    protected function getEnvironmentSetUp($app)
    {
        $app->setBasePath(__DIR__ . '/../..');
    }

    protected function getPackageProviders($app)
    {
        return [WireUiServiceProvider::class];
    }
}
