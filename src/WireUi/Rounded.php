<?php

namespace WireUi\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Rounded extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.rounded') ?? Packs\Rounded::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Rounded::NONE => 'rounded-none',
            Packs\Rounded::SM => 'rounded-sm',
            Packs\Rounded::BASE => 'rounded',
            Packs\Rounded::MD => 'rounded-md',
            Packs\Rounded::LG => 'rounded-lg',
            Packs\Rounded::XL => 'rounded-xl',
            Packs\Rounded::XL2 => 'rounded-2xl',
            Packs\Rounded::XL3 => 'rounded-3xl',
            Packs\Rounded::FULL => 'rounded-full',
        ];
    }
}
