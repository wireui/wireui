<?php

namespace WireUi\WireUi\Modal;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Width extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Width::X2L;
    }

    public function all(): array
    {
        return [
            Packs\Width::SM  => 'sm:max-w-sm',
            Packs\Width::MD  => 'sm:max-w-md',
            Packs\Width::LG  => 'sm:max-w-lg',
            Packs\Width::XL  => 'sm:max-w-xl',
            Packs\Width::X2L => 'sm:max-w-2xl',
            Packs\Width::X3L => 'sm:max-w-3xl',
            Packs\Width::X4L => 'sm:max-w-4xl',
            Packs\Width::X5L => 'sm:max-w-5xl',
            Packs\Width::X6L => 'sm:max-w-6xl',
            Packs\Width::X7L => 'sm:max-w-7xl',
        ];
    }
}
