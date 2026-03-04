<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;
use Tests\Browser\Macros\DuskBrowserMacros;
use function Livewire\trigger;

class BrowserTestCase extends TestCase
{
    public static function tweakApplicationHook()
    {
        return function () {};
    }

    protected function defineWebRoutes($router): void
    {
        $router->get('/api/options', function () {
            return collect([
                ['id' => 1, 'name' => 'Pedro'],
                ['id' => 2, 'name' => 'Keithy'],
                ['id' => 3, 'name' => 'Fernando'],
                ['id' => 4, 'name' => 'Andre'],
            ])->filter(function (array $option) {
                return str_contains(
                    strtolower($option['name']),
                    strtolower(request()->query('search', '')),
                );
            })->values();
        })->name('api.options');

        $router->get('/api/options/nested', function () {
            $data = collect([
                ['id' => 1, 'name' => 'Pedro'],
                ['id' => 2, 'name' => 'Keithy'],
                ['id' => 3, 'name' => 'Fernando'],
                ['id' => 4, 'name' => 'Andre'],
                ['id' => 5, 'name' => 'Tommy'],
            ])->filter(function (array $option) {
                return str_contains(
                    strtolower($option['name']),
                    strtolower(request()->query('search', '')),
                );
            })->values();

            return ['data' => ['nested' => $data]];
        })->name('api.options.nested');
    }

    public function setUp(): void
    {
        parent::setUp();

        trigger('browser.testCase.setUp', $this);
        Browser::mixin(new DuskBrowserMacros());
    }

    public function tearDown(): void
    {
        trigger('browser.testCase.tearDown', $this);

        parent::tearDown();
    }

    public function visit(Browser $browser, string $component, array $queryParams = []): Browser|Testable
    {
        return $this->livewire($browser, $component, $queryParams);
    }

    public function livewire(Browser $browser, string $component, array $queryParams = []): Browser|Testable
    {
        return $browser->livewire($component, $queryParams);
    }
}
