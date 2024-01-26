<?php

namespace WireUi\Components\Badge\WireUi;

use WireUi\Components\Badge\WireUi\Color\{Flat, Outline, Solid};
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
            'solid'   => Solid::class,
            'outline' => Outline::class,
        ];
    }
}
