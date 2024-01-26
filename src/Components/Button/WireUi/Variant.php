<?php

namespace WireUi\Components\Button\WireUi;

use WireUi\Components\Button\WireUi\Color\{Flat, Light, Outline, Solid};
use WireUi\Support\ComponentPack;

class Variant extends ComponentPack
{
    protected function default(): string
    {
        return 'solid';
    }

    public function all(): array
    {
        return [
            'flat'    => Flat::class,
            'light'   => Light::class,
            'solid'   => Solid::class,
            'outline' => Outline::class,
        ];
    }
}
