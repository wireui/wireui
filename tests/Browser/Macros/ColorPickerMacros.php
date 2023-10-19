<?php

namespace Tests\Browser\Macros;

use Laravel\Dusk\Browser;

trait ColorPickerMacros
{
    public function selectColorByTitle()
    {
        return function (string $name, string $title) {
            /** @var Browser $this */
            return $this->click(
                "[form-wrapper=\"{$name}\"] [x-ref=\"colorsContainer\"] button[title=\"{$title}\"]",
            );
        };
    }
}
