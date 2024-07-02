<?php

namespace WireUi\Components\Modal\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Type extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Type::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Type::BASE => [
                'z-index' => 'z-40',
                'spacing' => 'p-4',
                'soft-scrollbar' => false,
                'hide-scrollbar' => false,
            ],
            Packs\Type::SOFT => [
                'z-index' => 'z-40',
                'spacing' => 'p-4',
                'soft-scrollbar' => true,
                'hide-scrollbar' => false,
            ],
            Packs\Type::HIDE => [
                'z-index' => 'z-40',
                'spacing' => 'p-4',
                'soft-scrollbar' => false,
                'hide-scrollbar' => true,
            ],
        ];
    }
}
