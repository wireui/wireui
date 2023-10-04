<?php

namespace WireUi\WireUi\Badge;

use WireUi\Support\ComponentPack;
use WireUi\WireUi\Badge\Colors\{Flat, Outline, Solid};

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
            'outline' => Outline::class,
            'solid'   => Solid::class,
        ];
    }
}
