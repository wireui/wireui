<?php

namespace WireUi\WireUi\Button;

use WireUi\Support\ComponentPack;
use WireUi\WireUi\Button\Colors\{Flat, Light, Outline, Solid};

class Variants extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'solid';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'flat'    => Flat::class,
            'light'   => Light::class,
            'outline' => Outline::class,
            'solid'   => Solid::class,
        ];
    }
}
