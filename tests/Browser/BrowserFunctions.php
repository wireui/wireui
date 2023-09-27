<?php

namespace Tests\Browser;

use Illuminate\Support\Arr;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Console\DuskCommand;
use Psy\Shell;

trait BrowserFunctions
{
    public function visit(Browser $browser, string $livewire, $queryParams = [])
    {
        $url = '/livewire-dusk/' . urlencode($livewire) . '?' . Arr::query($queryParams);

        return $browser->visit($url)->waitForLivewireToLoad();
    }

    public function breakIntoATinkerShell($browsers, $e)
    {
        $sh = new Shell();

        $sh->add(new DuskCommand($this, $e));

        $sh->setScopeVariables(['browsers' => $browsers]);

        $sh->addInput('dusk');

        $sh->setBoundObject($this);

        $sh->run();

        return $sh->getScopeVariables(false);
    }

    protected function defineWebRoutes($router)
    {
        $router->get('/livewire-dusk/{component}', function (string $component) {
            $class = urldecode($component);

            return app()->call(app('livewire')->new($class));
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
