<?php

namespace Tests\Browser\Macros;

use Closure;
use Laravel\Dusk\Browser;

trait ColorPickerMacros
{
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
