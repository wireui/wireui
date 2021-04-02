<?php

namespace Tests\Browser;

use Closure;
use Exception;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Laravel\Dusk\Browser;
use Livewire\LivewireServiceProvider;
use Livewire\Macros\DuskBrowserMacros;
use Orchestra\Testbench\Dusk\Options as DuskOptions;
use Orchestra\Testbench\Dusk\TestCase as BaseTestCase;
use Psy\Shell;
use Throwable;
use WireUi\Providers\WireUiServiceProvider;

/** @link https://github.com/livewire/livewire/blob/master/tests/Browser/TestCase.php */
class BrowserTestCase extends BaseTestCase
{
    use SupportsSafari;

    public static $useSafari = false;

    public function setUp(): void
    {
        if (isset($_SERVER['CI'])) {
            DuskOptions::withoutUI();
        }

        Browser::mixin(new DuskBrowserMacros);

        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });

        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });

        parent::setUp();

        $this->tweakApplication(function () {
            Route::get('/livewire-dusk/{component}', function ($component) {
                $class = urldecode($component);

                return app()->call(new $class);
            })->middleware('web');

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
        $app->singleton(\Illuminate\Contracts\Http\Kernel::class, \Tests\HttpKernel::class);
    }

    protected function driver(): RemoteWebDriver
    {
        $options = DuskOptions::getChromeOptions();

        return static::$useSafari
            ? RemoteWebDriver::create(
                'http://localhost:9515', DesiredCapabilities::safari()
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
                if (DuskOptions::hasUI()) {
                    $this->breakIntoATinkerShell($browsers, $e);
                }

                throw $e;
            } catch (Throwable $e) {
                if (DuskOptions::hasUI()) {
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
}

