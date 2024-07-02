<?php

namespace WireUi\Components\Dropdown\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Height extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Height::XL3;
    }

    public function all(): array
    {
        return [
            Packs\Height::AUTO => 'h-auto',
            Packs\Height::SM => 'max-h-40',
            Packs\Height::MD => 'max-h-44',
            Packs\Height::LG => 'max-h-48',
            Packs\Height::XL => 'max-h-52',
            Packs\Height::XL2 => 'max-h-56',
            Packs\Height::XL3 => 'max-h-60',
            Packs\Height::XL4 => 'max-h-64',
            Packs\Height::XL5 => 'max-h-72',
            Packs\Height::XL6 => 'max-h-80',
            Packs\Height::XL7 => 'max-h-96',
        ];
    }
}
