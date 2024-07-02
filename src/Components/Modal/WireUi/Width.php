<?php

namespace WireUi\Components\Modal\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Width extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Width::XL2;
    }

    public function all(): array
    {
        return [
            Packs\Width::SM => 'sm:max-w-sm',
            Packs\Width::MD => 'sm:max-w-md',
            Packs\Width::LG => 'sm:max-w-lg',
            Packs\Width::XL => 'sm:max-w-xl',
            Packs\Width::XL2 => 'sm:max-w-2xl',
            Packs\Width::XL3 => 'sm:max-w-3xl',
            Packs\Width::XL4 => 'sm:max-w-4xl',
            Packs\Width::XL5 => 'sm:max-w-5xl',
            Packs\Width::XL6 => 'sm:max-w-6xl',
            Packs\Width::XL7 => 'sm:max-w-7xl',
        ];
    }
}
