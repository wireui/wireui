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
            Packs\Variant::FLAT => [
                'color' => Flat::class,
            ],
            Packs\Variant::LIGHT => [
                'color' => Light::class,
            ],
            Packs\Variant::OUTLINE => [
                'color' => Outline::class,
            ],
            Packs\Variant::SOLID => [
                'color' => Solid::class,
            ],
        ];
    }
}
