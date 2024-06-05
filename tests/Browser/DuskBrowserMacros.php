<?php

namespace Tests\Browser;

use Closure;
use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\DuskBrowserMacros as BaseDuskBrowserMacros;

class DuskBrowserMacros extends BaseDuskBrowserMacros
{
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

    public function toggleSelect(): Closure
    {
        return function (mixed $name = null) {
            $name ??= 'form.wrapper.container';

            /** @var Browser $this */
            return $this->pause(500)->click("label[name=\"{$name}\"] > button");
        };
    }

    public function toggleWrapper(): Closure
    {
        return function (mixed $name = null) {
            $name ??= 'form.wrapper.container';

            /** @var Browser $this */
            return $this->pause(500)->click("label[name=\"{$name}\"] > input");
        };
    }

    public function waitToSelectValue(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->waitTo(function (Browser $browser) use ($name) {
                return $browser->assertSeeIn('div[name="wireui.select.options.model"] > ul', $name);
            });
        };
    }

    public function wireUiSelectValue(): Closure
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

    public function selectDate(): Closure
    {
        return function (string $id, int $day) {
            /** @var Browser $this */
            return $this->script(<<<JS
                window.check{$id} = [...Array(31).keys().map((i, k) => ++k)];

                [...document.querySelectorAll('[id="{$id}"] [x-show="tab === \'calendar\'"] button')]
                    .filter((day) => {
                        return day.innerText != window.check{$id}[0] ? false : Boolean(window.check{$id}.shift());
                    })
                    .find(day => day.innerText == {$day})
                    .click();
            JS);
        };
    }

    /**
     * Popover Macros.
     */
    public function togglePopover(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->click("[form-wrapper=\"{$name}\"] [x-on\\:click=\"positionable.toggle()\"]");
        };
    }

    public function openPopover(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */

            return $this
                ->togglePopover($name)
                ->assertPopoverIsOpen($name);
        };
    }

    public function assertPopoverIsOpen(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->waitUsing(30, 300, function () use ($name) {
                /** @var Browser $this */
                return $this->assertVisible("[form-wrapper=\"{$name}\"] [x-ref=\"popover\"]");
            });
        };
    }

    public function assertPopoverIsClosed(): Closure
    {
        return function (string $name) {
            /** @var Browser $this */
            return $this->waitUsing(30, 300, function () use ($name) {
                /** @var Browser $this */
                return $this->assertNotVisible("[form-wrapper=\"{$name}\"] [x-ref=\"popover\"]");
            });
        };
    }
}
