<?php

namespace WireUi\Components\Badge\WireUi;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class IconSize extends ComponentPack
{
    protected function default(): string
    {
        return Size::SM;
    }

    public function all(): array
    {
        return [
            Size::SM => 'w-3 h-3',
            Size::MD => 'w-4 h-4',
            Size::LG => 'w-5 h-5',
        ];
    }
}
