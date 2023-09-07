<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\{Artisan, File};
use Laravel\Dusk\Browser;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Dusk\{Options, TestCase};
use Tests\Browser\Macros\DuskBrowserMacros;
use WireUi\Providers\WireUiServiceProvider;

/** @link https://github.com/livewire/livewire/blob/main/tests/BrowserTestCase.php */
class BrowserTestCase extends TestCase
{
    use BrowserFunctions;

    protected function setUp(): void
    {
        if (isset($_SERVER['CI'])) {
            Options::withoutUI();
        }

        Browser::$waitSeconds = 7;

        Browser::mixin(new DuskBrowserMacros());

        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();

        $testCase = new self('browser');

        $this->tweakApplication(function () use ($testCase) {
            $testCase->auxAutoloadComponents();

            $testCase->auxDefineRoutes();

            $testCase->auxUpdateConfigs();
        });
    }

    protected function tearDown(): void
    {
        $this->removeApplicationTweaks();

        parent::tearDown();
    }

    public function makeACleanSlate()
    {
        Artisan::call('view:clear');

        File::deleteDirectory($this->livewireViewsPath());
        File::deleteDirectory($this->livewireClassesPath());
        File::deleteDirectory($this->livewireTestsPath());
        File::delete(app()->bootstrapPath('cache/livewire-components.php'));
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            WireUiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            __DIR__ . '/views',
            resource_path('views'),
        ]);

        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function livewireClassesPath($path = '')
    {
        return app_path('Livewire' . ($path ? '/' . $path : ''));
    }

    protected function livewireViewsPath($path = '')
    {
        return resource_path('views') . '/livewire' . ($path ? '/' . $path : '');
    }

    protected function livewireTestsPath($path = '')
    {
        return base_path('tests/Feature/Livewire' . ($path ? '/' . $path : ''));
    }
}
