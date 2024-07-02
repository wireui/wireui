<?php

namespace WireUi\Components\Button\WireUi\Size;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class Mini extends ComponentPack
{
    protected function default(): string
    {
        return Size::MD;
    }

    public function all(): array
    {
        return [
            Size::XS2 => 'text-2xs w-5 h-5',
            Size::XS => 'text-xs w-7 h-7',
            Size::SM => 'text-sm w-8 h-8',
            Size::MD => 'text-sm w-9 h-9',
            Size::LG => 'text-base w-10 h-10',
            Size::XL => 'text-lg w-12 h-12',
            Size::XL2 => 'text-xl w-14 h-14',
        ];
    }
}
