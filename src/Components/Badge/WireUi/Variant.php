<?php

namespace WireUi\Components\Badge\WireUi;

use WireUi\Components\Badge\WireUi\Color\Flat;
use WireUi\Components\Badge\WireUi\Color\Outline;
use WireUi\Components\Badge\WireUi\Color\Solid;
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
            Packs\Variant::OUTLINE => [
                'color' => Outline::class,
            ],
            Packs\Variant::SOLID => [
                'color' => Solid::class,
            ],
        ];
    }
}
