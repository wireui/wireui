<?php

namespace WireUi\Components\Alert\WireUi;

use WireUi\Components\Alert\WireUi\Color\Flat;
use WireUi\Components\Alert\WireUi\Color\Outline;
use WireUi\Components\Alert\WireUi\Color\Solid;
use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Variant extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Variant::FLAT;
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
