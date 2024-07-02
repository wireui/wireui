<?php

namespace WireUi\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Shadow extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.shadow') ?? Packs\Shadow::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Shadow::NONE => 'shadow-none',
            Packs\Shadow::SM => 'shadow-sm',
            Packs\Shadow::BASE => 'shadow',
            Packs\Shadow::MD => 'shadow-md',
            Packs\Shadow::LG => 'shadow-lg',
            Packs\Shadow::XL => 'shadow-xl',
            Packs\Shadow::XL2 => 'shadow-2xl',
            Packs\Shadow::INNER => 'shadow-inner',
        ];
    }
}
