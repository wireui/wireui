<?php

namespace WireUi\Components\Drawer\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Height extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Height::XL2;
    }

    public function all(): array
    {
        return [
            Packs\Height::SM => '',
            Packs\Height::MD => '',
            Packs\Height::LG => '',
            Packs\Height::XL => '',
            Packs\Height::XL2 => '',
            Packs\Height::XL3 => '',
            Packs\Height::XL4 => '',
            Packs\Height::XL5 => '',
            Packs\Height::XL6 => '',
            Packs\Height::XL7 => '',
        ];
    }
}
