<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Border extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Border::THIN;
    }

    public function all(): array
    {
        return [
            Packs\Border::THIN  => 'border',
            Packs\Border::BASE  => 'border-2',
            Packs\Border::THICK => 'border-4',
        ];
    }
}
