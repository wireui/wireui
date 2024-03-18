<?php

namespace Tests\Browser\Macros;

use Closure;
use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\DuskBrowserMacros as BaseDuskBrowserMacros;

class DuskBrowserMacros extends BaseDuskBrowserMacros
{
    use PopoverMacros;

    public function waitTo(): Closure
    {
        return function (Closure $closure) {
            /** @var Browser $this */
            return $this->waitUsing(30, 300, fn () => $closure($this));
        };
    }

    public function waitForAlpineJs(): Closure
    {
        return function () {
            /** @var Browser $this */
            return $this
                ->waitUsing(30, 300, fn () => $this->assertScript('return !!window.Alpine?.initialized'))
                ->pause(100);
        };
    }

    public function openSelect(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->tap(fn (Browser $browser) => $browser->script(<<<JS
                Alpine.evaluate(document.querySelector("input[name=\"{$name}\"]"), 'open')
            JS));
        };
    }

    public function wireuiSelectValue(): Closure
    {
        return function (string $name, int $index) {
            /** @var Browser $this */
            return $this->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll("div[name=\"wireui.select.options.{$name}\"] [select-option]")[{$index}].click();
            JS));
        };
    }

    public function selectColorByTitle(): Closure
    {
        return function (string $name, string $title) {
            /** @var Browser $this */
            return $this->click(
                "[form-wrapper=\"{$name}\"] [x-ref=\"colorsContainer\"] button[title=\"{$title}\"]",
            );
        };
    }
}
