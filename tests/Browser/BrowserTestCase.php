<?php

namespace Tests\Browser;

use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Laravel\Dusk\Browser;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Dusk\Options;
use Orchestra\Testbench\Dusk\TestCase;
use Tests\Unit\Interacts;
use WireUi\Heroicons\HeroiconsServiceProvider;
use WireUi\ServiceProvider;

use function Livewire\trigger;

/**
 * @link https://github.com/livewire/livewire/blob/main/tests/BrowserTestCase.php
 */
class BrowserTestCase extends TestCase
{
    use BrowserFunctions;
    use Interacts;

    protected function setUp(): void
    {
        if (isset($_SERVER['CI'])) {
            Options::withoutUI();
        }

        Browser::$waitSeconds = 7;

        Browser::mixin(new DuskBrowserMacros);

        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();

        trigger('browser.testCase.setUp', $this);
    }

    protected function tearDown(): void
    {
        $this->removeApplicationTweaks();

        trigger('browser.testCase.tearDown', $this);

        if (! $this->status()->isSuccess()) {
            $this->captureFailuresFor(collect(static::$browsers));
            $this->storeSourceLogsFor(collect(static::$browsers));
        }

        $this->closeAll();

        parent::tearDown();
    }

    protected function makeACleanSlate(): void
    {
        Artisan::call('view:clear');

        File::deleteDirectory(self::tmpPath());
        File::deleteDirectory($this->livewireViewsPath());
        File::deleteDirectory($this->livewireClassesPath());
        File::deleteDirectory($this->livewireTestsPath());
        File::delete(app()->bootstrapPath('cache/livewire-components.php'));

        File::ensureDirectoryExists(self::tmpPath());
    }

    public static function tweakApplicationHook(): Closure
    {
        return function () {
            //
        };
    }

    protected function getPackageProviders($app)
    {
        return [
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
            $config->set('app.env', 'testing');

            $config->set('app.debug', true);

            $config->set('view.paths', [__DIR__.'/views', resource_path('views')]);

            $config->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

            $config->set('database.default', 'testbench');

            $config->set('database.connections.testbench', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]);
        });
    }

    public static function tmpPath(string $path = ''): string
    {
        return __DIR__."/tmp/{$path}";
    }

    protected function livewireClassesPath($path = ''): string
    {
        return app_path('Livewire'.($path ? '/'.$path : ''));
    }

    protected function livewireViewsPath($path = ''): string
    {
        return resource_path('views').'/livewire'.($path ? '/'.$path : '');
    }

    protected function livewireTestsPath($path = ''): string
    {
        return base_path('tests/Feature/Livewire'.($path ? '/'.$path : ''));
    }
}
