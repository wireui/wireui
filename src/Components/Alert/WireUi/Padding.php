<?php

namespace WireUi\Components\Alert\WireUi;

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
            Packs\Padding::NONE => 'ms-2 me-2',
            Packs\Padding::SMALL => 'ps-1 pe-1 mt-1 ms-3 me-3',
            Packs\Padding::MEDIUM => 'ps-1 pe-1 mt-2 ms-5 me-5',
            Packs\Padding::LARGE => 'ps-1 pe-1 mt-3 ms-7 me-7',
        ];
    }
}
