<?php

namespace WireUi\Components\Modal\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Blur extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Blur::NONE;
    }

    public function all(): array
    {
        return [
            Packs\Blur::NONE => 'backdrop-blur-none',
            Packs\Blur::SM => 'backdrop-blur-sm',
            Packs\Blur::BASE => 'backdrop-blur',
            Packs\Blur::MD => 'backdrop-blur-md',
            Packs\Blur::LG => 'backdrop-blur-lg',
            Packs\Blur::XL => 'backdrop-blur-xl',
            Packs\Blur::XL2 => 'backdrop-blur-2xl',
            Packs\Blur::XL3 => 'backdrop-blur-3xl',
        ];
    }
}
