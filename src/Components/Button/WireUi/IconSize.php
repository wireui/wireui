<?php

namespace WireUi\Components\Button\WireUi;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class IconSize extends ComponentPack
{
    protected function default(): string
    {
        return Size::MD;
    }

    public function all(): array
    {
        return [
            Size::XS2 => 'w-2 h-2',
            Size::XS => 'w-3 h-3',
            Size::SM => 'w-3.5 h-3.5',
            Size::MD => 'w-4 h-4',
            Size::LG => 'w-5 h-5',
            Size::XL => 'w-6 h-6',
            Size::XL2 => 'w-7 h-7',
        ];
    }
}
