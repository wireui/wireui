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
            Packs\Padding::NONE => 'ml-2',
            Packs\Padding::SMALL => 'pl-1 mt-1 ml-3',
            Packs\Padding::MEDIUM => 'pl-1 mt-2 ml-5',
            Packs\Padding::LARGE => 'pl-1 mt-3 ml-7',
        ];
    }
}
