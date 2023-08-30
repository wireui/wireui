<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Artisan;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use ReflectionClass;
use WireUi\Heroicons\HeroiconsServiceProvider;
use WireUi\WireUiServiceProvider;

class TestCase extends TestbenchTestCase
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();
    }

    protected function defineWebRoutes($router)
    {
        base_path('src/routes/web.php');
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            WireUiServiceProvider::class,
            HeroiconsServiceProvider::class,
        ];
    }

    public function makeACleanSlate(): void
    {
        Artisan::call('view:clear');
    }

    /** Call protected/private method of a class */
    public function invokeMethod(mixed $object, string $method, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));

        $method = $reflection->getMethod($method);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /** Get protected/private property value of a class */
    public function invokeProperty(mixed $object, string $property)
    {
        $reflection = new ReflectionClass(get_class($object));

        $property = $reflection->getProperty($property);

        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
