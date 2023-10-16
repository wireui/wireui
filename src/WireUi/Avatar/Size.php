<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Size extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Size::MD;
    }

    public function all(): array
    {
        return [
            Packs\Size::XXS => 'w-6 h-6',
            Packs\Size::XS  => 'w-7 h-7',
            Packs\Size::SM  => 'w-8 h-8',
            Packs\Size::MD  => 'w-10 h-10',
            Packs\Size::LG  => 'w-12 h-12',
            Packs\Size::XL  => 'w-14 h-14',
            Packs\Size::XXL => 'w-18 h-18',
        ];
    }
}
