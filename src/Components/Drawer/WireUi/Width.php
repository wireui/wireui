<?php

namespace WireUi\Components\Drawer\WireUi;

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
            Packs\Width::SM => '',
            Packs\Width::MD => '',
            Packs\Width::LG => '',
            Packs\Width::XL => '',
            Packs\Width::XL2 => '',
            Packs\Width::XL3 => '',
            Packs\Width::XL4 => '',
            Packs\Width::XL5 => '',
            Packs\Width::XL6 => '',
            Packs\Width::XL7 => '',
        ];
    }
}
