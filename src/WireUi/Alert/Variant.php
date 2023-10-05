<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;
use WireUi\WireUi\Alert\Color\{Flat, Outline, Solid};

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
            'outline' => Outline::class,
            'solid'   => Solid::class,
        ];
    }
}
