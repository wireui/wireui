<?php

namespace WireUi\WireUi\Notification;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Position extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Position::TOP_RIGHT;
    }

    public function all(): array
    {
        return [
            Packs\Position::TOP          => 'sm:items-start sm:justify-center',
            Packs\Position::TOP_LEFT     => 'sm:items-start sm:justify-start',
            Packs\Position::TOP_RIGHT    => 'sm:items-start sm:justify-end',
            Packs\Position::BOTTOM       => 'sm:items-end sm:justify-center',
            Packs\Position::BOTTOM_LEFT  => 'sm:items-end sm:justify-start',
            Packs\Position::BOTTOM_RIGHT => 'sm:items-end sm:justify-end',
        ];
    }
}
