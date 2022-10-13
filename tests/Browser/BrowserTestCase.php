<?php

namespace Tests\Browser;

use Closure;
use Exception;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\{DesiredCapabilities, RemoteWebDriver};
use Illuminate\Support\Facades\{Artisan, File, Route};
use Laravel\Dusk\Browser;
use function Livewire\str;
use Livewire\Testing\TestableLivewire;
use Livewire\{Component, Livewire, LivewireServiceProvider};
use Orchestra\Testbench\Dusk;
use Psy\Shell;
use Symfony\Component\Finder\SplFileInfo;
use Tests\Browser\Macros\DuskBrowserMacros;
use Throwable;
use WireUi\Providers\WireUiServiceProvider;

/** @link https://github.com/livewire/livewire/blob/master/tests/Browser/TestCase.php */
class BrowserTestCase extends Dusk\TestCase
{
    use SupportsSafari;

    public static $useSafari = false;

    protected function setUp(): void
    {
        if (isset($_SERVER['CI'])) {
            Dusk\Options::withoutUI();
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

        $this->tweakApplication(function () {
            // Autoload all Livewire components in this test suite.
            collect(File::allFiles(__DIR__))
                ->map(function (SplFileInfo $file) {
                    return 'Tests\\Browser\\' . str($file->getRelativePathname())->before('.php')->replace('/', '\\');
                })->filter(function (string $computedClassName) {
                    return class_exists($computedClassName)
                        && is_subclass_of($computedClassName, Component::class);
                })->each(function (string $componentClass) {
                    app('livewire')->component($componentClass);
                });

            Route::get('/livewire-dusk/{component}', function (string $component) {
                $class = urldecode($component);

                return app()->call(new $class);
            })->middleware('web');

            Route::get('/api/options', function () {
                return collect([
                    ['id' => 1, 'name' => 'Pedro'],
                    ['id' => 2, 'name' => 'Keithy'],
                    ['id' => 3, 'name' => 'Fernando'],
                    ['id' => 4, 'name' => 'Andre'],
                ])->filter(function (array $option) {
                    return str_contains(
                        strtolower($option['name']),
                        strtolower(request()->query('search'))
                    );
                })->values();
            })->name('api.options')->middleware('web');

            Route::get('/api/options/nested', function () {
                $data = collect([
                    ['id' => 1, 'name' => 'Pedro'],
                    ['id' => 2, 'name' => 'Keithy'],
                    ['id' => 3, 'name' => 'Fernando'],
                    ['id' => 4, 'name' => 'Andre'],
                    ['id' => 5, 'name' => 'Tommy'],
                ])->filter(function (array $option) {
                    return str_contains(
                        strtolower($option['name']),
                        strtolower(request()->query('search'))
                    );
                })->values();
                return ['data' => ['nested' => $data]];
            })->name('api.options.nested')->middleware('web');

            app('session')->put('_token', 'this-is-a-hack-because-something-about-validating-the-csrf-token-is-broken');

            app('config')->set('view.paths', [
                __DIR__ . '/views',
                resource_path('views'),
            ]);

            config()->set('app.debug', true);
        });
    }

    protected function tearDown(): void
    {
        $this->removeApplicationTweaks();

        parent::tearDown();
    }

    // We don't want to deal with screenshots or console logs.
    protected function storeConsoleLogsFor($browsers)
    {
    }

    protected function captureFailuresFor($browsers)
    {
    }

    public function makeACleanSlate()
    {
        Artisan::call('view:clear');

        File::deleteDirectory($this->livewireViewsPath());
        File::deleteDirectory($this->livewireClassesPath());
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

    protected function resolveApplicationHttpKernel($app)
    {
        $app->singleton(\Illuminate\Contracts\Http\Kernel::class, HttpKernel::class);
    }

    protected function livewireClassesPath($path = '')
    {
        return app_path('Http/Livewire' . ($path ? '/' . $path : ''));
    }

    protected function livewireViewsPath($path = '')
    {
        return resource_path('views') . '/livewire' . ($path ? '/' . $path : '');
    }

    protected function driver(): RemoteWebDriver
    {
        $options = Dusk\Options::getChromeOptions();

        return static::$useSafari
            ? RemoteWebDriver::create(
                'http://localhost:9515',
                DesiredCapabilities::safari()
            )
            : RemoteWebDriver::create(
                'http://localhost:9515',
                DesiredCapabilities::chrome()->setCapability(
                    ChromeOptions::CAPABILITY,
                    $options
                )
            );
    }

    public function browse(Closure $callback)
    {
        parent::browse(function (...$browsers) use ($callback) {
            try {
                $callback(...$browsers);
            } catch (Exception $e) {
                if (Dusk\Options::hasUI()) {
                    $this->breakIntoATinkerShell($browsers, $e);
                }

                throw $e;
            } catch (Throwable $e) {
                if (Dusk\Options::hasUI()) {
                    $this->breakIntoATinkerShell($browsers, $e);
                }

                throw $e;
            }
        });
    }

    public function breakIntoATinkerShell($browsers, $e)
    {
        $sh = new Shell();

        $sh->add(new DuskCommand($this, $e));

        $sh->setScopeVariables([
            'browsers' => $browsers,
        ]);

        $sh->addInput('dusk');

        $sh->setBoundObject($this);

        $sh->run();

        return $sh->getScopeVariables(false);
    }

    public function visit(Browser $browser, string $livewire): Browser|TestableLivewire
    {
        return Livewire::visit($browser, $livewire)
            ->tap(fn (Browser $browser) => $browser->waitForLivewireToLoad());
    }
}
