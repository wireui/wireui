<?php

namespace WireUi\WireUi\Card;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Padding extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Padding::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Padding::BASE => 'px-2 py-5 md:px-4',
        ];
    }
}
