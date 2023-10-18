<?php

namespace WireUi\WireUi\Badge;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;
use WireUi\WireUi\Badge\Color\{Flat, Outline, Solid};

class Variant extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Variant::SOLID;
    }

    public function all(): array
    {
        return [
            Packs\Variant::FLAT    => Flat::class,
            Packs\Variant::OUTLINE => Outline::class,
            Packs\Variant::SOLID   => Solid::class,
        ];
    }
}
