<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\{Artisan, File};
use Illuminate\Support\{Collection, Str};
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;
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
            WireUiServiceProvider::class,
            LivewireServiceProvider::class,
            HeroiconsServiceProvider::class,
        ];
    }

    public function makeACleanSlate(): void
    {
        Artisan::call('view:clear');
    }

    /** Call protected/private method of a class */
    public function invokeMethod(mixed $object, string $method, array $parameters = []): mixed
    {
        $reflection = new ReflectionClass(get_class($object));

        $method = $reflection->getMethod($method);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /** Get protected/private property value of a class */
    public function invokeProperty(mixed $object, string $property): mixed
    {
        $reflection = new ReflectionClass(get_class($object));

        $property = $reflection->getProperty($property);

        $property->setAccessible(true);

        return $property->getValue($object);
    }

    /** Get some package class to use in traits test */
    public function getPackageClass(string $word): string
    {
        $files = File::allFiles(__DIR__ . '/../../src/WireUi');

        $classes = collect($files)->map(function (SplFileInfo $file) {
            return $file->getRelativePathname();
        })->map(function ($class) {
            return 'WireUi\\WireUi\\' . str($class)->before('.php')->replace('/', '\\');
        });

        return $classes->filter(fn ($class) => str($class)->contains($word))->random();
    }

    public function getIcons(): Collection
    {
        $files = File::allFiles(__DIR__ . '/../../vendor/wireui/heroicons/src/views/components/outline');

        return collect($files)->map(function (SplFileInfo $file) {
            return Str::of($file->getFilename())->before('.blade.php')->toString();
        })->sort();
    }
}
