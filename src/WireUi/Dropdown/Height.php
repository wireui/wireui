<?php

namespace WireUi\WireUi\Dropdown;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Height extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Height::X3L;
    }

    public function all(): array
    {
        return [
            Packs\Height::SM  => 'max-h-40',
            Packs\Height::MD  => 'max-h-44',
            Packs\Height::LG  => 'max-h-48',
            Packs\Height::XL  => 'max-h-52',
            Packs\Height::X2L => 'max-h-56',
            Packs\Height::X3L => 'max-h-60',
            Packs\Height::X4L => 'max-h-64',
            Packs\Height::X5L => 'max-h-72',
            Packs\Height::X6L => 'max-h-80',
            Packs\Height::X7L => 'max-h-96',
        ];
    }
}
