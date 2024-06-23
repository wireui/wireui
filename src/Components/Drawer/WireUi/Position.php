<?php

namespace WireUi\Components\Drawer\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Position extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Position::RIGHT;
    }

    public function all(): array
    {
        return [
            Packs\Position::TOP => '',
            Packs\Position::RIGHT => '',
            Packs\Position::BOTTOM => '',
            Packs\Position::LEFT => '',
        ];
    }
}
