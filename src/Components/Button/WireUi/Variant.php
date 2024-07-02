<?php

namespace WireUi\Components\Button\WireUi;

use WireUi\Components\Button\WireUi\Color\Flat;
use WireUi\Components\Button\WireUi\Color\Light;
use WireUi\Components\Button\WireUi\Color\Outline;
use WireUi\Components\Button\WireUi\Color\Solid;
use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Variant extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Variant::SOLID;
    }

    public function all(): array
    {
        return [
            Packs\Variant::FLAT => Flat::class,
            Packs\Variant::LIGHT => Light::class,
            Packs\Variant::OUTLINE => Outline::class,
            Packs\Variant::SOLID => Solid::class,
        ];
    }
}
