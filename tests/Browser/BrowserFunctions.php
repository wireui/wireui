<?php

namespace Tests\Browser;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\View;
use Illuminate\Support\{Arr, Str};
use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;

/** @mixin BrowserTestCase */
trait BrowserFunctions
{
    /** @return Browser|Testable */
    public function visitation(Browser $browser, string $html): Browser
    {
        $uuid = (string) Str::uuid();

        $path = self::tmpPath("{$uuid}.blade.php");

        $blade = <<<BLADE
        <x-layouts.app>
            {$html}
        </x-layouts.app>
        BLADE;

        file_put_contents($path, $blade);

        return $browser->visit('/testing/' . base64_encode($path));
    }

    public function visit(Browser $browser, string $livewire, $queryParams = [])
    {
        $url = '/livewire-dusk/' . urlencode($livewire) . '?' . Arr::query($queryParams);

        return $browser->visit($url)->waitForLivewireToLoad();
    }

    /** @param Router $router */
    protected function defineWebRoutes($router)
    {
        $router->get('/testing/{path}', function (string $path) {
            $path = base64_decode($path);

            return View::file($path);
        });

        $router->get('/api/options', function () {
            return collect([
                ['id' => 1, 'name' => 'Pedro'],
                ['id' => 2, 'name' => 'Keithy'],
                ['id' => 3, 'name' => 'Fernando'],
                ['id' => 4, 'name' => 'Andre'],
            ])->filter(function (array $option) {
                return str_contains(
                    strtolower($option['name']),
                    strtolower(request()->query('search')),
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
                    strtolower(request()->query('search')),
                );
            })->values();

            return ['data' => ['nested' => $data]];
        })->name('api.options.nested');
    }
}
