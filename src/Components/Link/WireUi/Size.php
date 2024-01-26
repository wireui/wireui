<?php

namespace WireUi\Components\Link\WireUi;

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
            Packs\Size::SM => 'text-sm',
            Packs\Size::MD => 'text-base',
            Packs\Size::LG => 'text-lg',
        ];
    }
}
