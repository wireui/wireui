<?php

namespace WireUi\WireUi\Button\Size;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class Base extends ComponentPack
{
    protected function default(): string
    {
        return Size::MD;
    }

    public function all(): array
    {
        return [
            Size::XXS => 'gap-x-0.5 text-2xs px-2 py-0.5',
            Size::XS  => 'gap-x-1 text-xs px-2.5 py-1.5',
            Size::SM  => 'gap-x-2 text-sm leading-4 px-3 py-2',
            Size::MD  => 'gap-x-2 text-sm px-4 py-2',
            Size::LG  => 'gap-x-2 text-base px-4 py-2.5',
            Size::XL  => 'gap-x-2 text-lg px-6 py-3',
            Size::XXL => 'gap-x-3 text-xl px-7 py-4',
        ];
    }
}
