<?php

namespace Tests\Browser\Macros;

use Illuminate\Support\Arr;
use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\DuskBrowserMacros as BaseDuskBrowserMacros;

class DuskBrowserMacros extends BaseDuskBrowserMacros
{
    public function livewire()
    {
        return function (string $component, array $queryParams = []) {
            /** @var Browser $this */
            $query = Arr::query($queryParams);
            $url = '/livewire-dusk/'.urlencode($component).($query === '' ? '' : '?'.$query);

            return $this->visit($url)->waitForLivewireToLoad();
        };
    }

    public function openSelect()
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->tap(fn (Browser $browser) => $browser->script(<<<JS
                Alpine.evaluate(document.querySelector("input[name=\"{$name}\"]"), 'open')
            JS));
        };
    }

    public function wireuiSelectValue()
    {
        return function (string $name, int $index) {
            /** @var Browser $this */
            return $this->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll("div[name=\"wireui.select.options.{$name}\"] [select-option]")[{$index}].click();
            JS));
        };
    }
}
