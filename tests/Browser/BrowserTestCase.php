<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\{Artisan, File};
use Laravel\Dusk\Browser;
use Livewire\LivewireServiceProvider;
use Livewire\Volt\{Volt, VoltServiceProvider};
use Orchestra\Testbench\Dusk\{Options, TestCase};
use Tests\Browser\Macros\DuskBrowserMacros;
use WireUi\Heroicons\HeroiconsServiceProvider;
use WireUi\ServiceProvider;

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

        $this->tweakApplication(fn () => Volt::mount(__DIR__));
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
            VoltServiceProvider::class,
            ServiceProvider::class,
            LivewireServiceProvider::class,
            HeroiconsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        tap($app['session'], function ($session) {
            $session->put('_token', str()->random(40));
        });

        tap($app['config'], function ($config) {
            $config->set('app.debug', true);

            $config->set('view.paths', [__DIR__ . '/views', resource_path('views')]);

            $config->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

            $config->set('database.default', 'testbench');

            $config->set('database.connections.testbench', [
                'driver'   => 'sqlite',
                'database' => ':memory:',
                'prefix'   => '',
            ]);
        });
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
