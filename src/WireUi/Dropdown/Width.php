<?php

namespace WireUi\WireUi\Dropdown;

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
            Packs\Width::SM  => 'w-40',
            Packs\Width::MD  => 'w-44',
            Packs\Width::LG  => 'w-48',
            Packs\Width::XL  => 'w-52',
            Packs\Width::X2L => 'w-56',
            Packs\Width::X3L => 'w-60',
            Packs\Width::X4L => 'w-64',
            Packs\Width::X5L => 'w-72',
            Packs\Width::X6L => 'w-80',
            Packs\Width::X7L => 'w-96',
        ];
    }
}
