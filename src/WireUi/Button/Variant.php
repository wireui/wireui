<?php

namespace WireUi\WireUi\Button;

use WireUi\Support\ComponentPack;
use WireUi\WireUi\Button\Colors\{Flat, Light, Outline, Solid};

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
            'outline' => Outline::class,
            'solid'   => Solid::class,
        ];
    }
}
