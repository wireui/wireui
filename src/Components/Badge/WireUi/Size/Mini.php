<?php

namespace WireUi\Components\Badge\WireUi\Size;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class Mini extends ComponentPack
{
    protected function default(): string
    {
        return Size::SM;
    }

    public function all(): array
    {
        return [
            Size::SM => 'w-6 h-6',
            Size::MD => 'w-7 h-7',
            Size::LG => 'w-8 h-8',
        ];
    }
}
