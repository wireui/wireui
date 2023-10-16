<?php

namespace Tests\Browser\Macros;

use Closure;
use Laravel\Dusk\Browser;

trait PopoverMacros
{
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
