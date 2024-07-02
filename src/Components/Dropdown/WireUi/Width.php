<?php

namespace WireUi\Components\Dropdown\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Width extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Width::LG;
    }

    public function all(): array
    {
        return [
            Packs\Width::SM => 'w-40',
            Packs\Width::MD => 'w-44',
            Packs\Width::LG => 'w-48',
            Packs\Width::XL => 'w-52',
            Packs\Width::XL2 => 'w-56',
            Packs\Width::XL3 => 'w-60',
            Packs\Width::XL4 => 'w-64',
            Packs\Width::XL5 => 'w-72',
            Packs\Width::XL6 => 'w-80',
            Packs\Width::XL7 => 'w-96',
        ];
    }
}
