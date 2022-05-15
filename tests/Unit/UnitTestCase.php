<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase;
use ReflectionClass;
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

    /** Call protected/private method of a class */
    public function invokeMethod($object, string $method, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
