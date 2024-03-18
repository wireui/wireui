<?php

namespace WireUi\Components\Badge\WireUi\Size;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class Base extends ComponentPack
{
    protected function default(): string
    {
        return Size::SM;
    }

    public function all(): array
    {
        return [
            Size::SM => 'gap-x-1 text-xs font-semibold px-2.5 py-0.5',
            Size::MD => 'gap-x-1 text-sm font-semibold px-2.5 py-0.5',
            Size::LG => 'gap-x-1 text-base font-semibold px-2.5 py-0.5',
        ];
    }
}
