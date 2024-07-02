<?php

namespace WireUi\Components\Card\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Padding extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Padding::MEDIUM;
    }

    public function all(): array
    {
        return [
            Packs\Padding::NONE => 'p-0',
            Packs\Padding::SMALL => 'px-1 py-3 md:px-2',
            Packs\Padding::MEDIUM => 'px-2 py-5 md:px-4',
            Packs\Padding::LARGE => 'px-3 py-6 md:px-5',
        ];
    }
}
