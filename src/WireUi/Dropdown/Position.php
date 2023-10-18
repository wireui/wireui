<?php

namespace WireUi\WireUi\Dropdown;

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
            Packs\Position::RIGHT     => 'origin-top-right right-0',
            Packs\Position::LEFT      => 'origin-top-left left-0',
            Packs\Position::TOP_RIGHT => 'origin-top-right right-0 bottom-0',
            Packs\Position::TOP_LEFT  => 'origin-top-left left-0 bottom-0',
        ];
    }
}
