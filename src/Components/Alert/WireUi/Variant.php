<?php

namespace WireUi\Components\Alert\WireUi;

use WireUi\Components\Alert\WireUi\Color\{Flat, Outline, Solid};
use WireUi\Support\ComponentPack;

class Variant extends ComponentPack
{
    protected function default(): string
    {
        return 'flat';
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
