<?php

namespace WireUi\Components\Switcher\WireUi\Radio;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Size extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Size::SM;
    }

    public function all(): array
    {
        return [
            Packs\Size::XS => 'w-3 h-3',
            Packs\Size::SM => 'w-4 h-4',
            Packs\Size::MD => 'w-5 h-5',
            Packs\Size::LG => 'w-6 h-6',
            Packs\Size::XL => 'w-7 h-7',
        ];
    }
}
