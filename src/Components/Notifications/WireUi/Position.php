<?php

namespace WireUi\Components\Notifications\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Position extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Position::TOP_END;
    }

    public function all(): array
    {
        return [
            Packs\Position::TOP => 'sm:items-start sm:justify-center',
            Packs\Position::TOP_START => 'sm:items-start sm:justify-start',
            Packs\Position::TOP_END => 'sm:items-start sm:justify-end',
            Packs\Position::BOTTOM => 'sm:items-end sm:justify-center',
            Packs\Position::BOTTOM_START => 'sm:items-end sm:justify-start',
            Packs\Position::BOTTOM_END => 'sm:items-end sm:justify-end',
        ];
    }
}
