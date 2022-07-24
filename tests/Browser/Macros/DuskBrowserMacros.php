<?php

namespace Tests\Browser\Macros;

use Laravel\Dusk\Browser;
use Livewire\Macros;

class DuskBrowserMacros extends Macros\DuskBrowserMacros
{
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
