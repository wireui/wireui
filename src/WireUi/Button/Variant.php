<?php

namespace WireUi\WireUi\Button;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;
use WireUi\WireUi\Button\Color\{Flat, Light, Outline, Solid};

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
            Packs\Variant::LIGHT   => Light::class,
            Packs\Variant::OUTLINE => Outline::class,
            Packs\Variant::SOLID   => Solid::class,
        ];
    }
}
