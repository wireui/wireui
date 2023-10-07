<?php

namespace WireUi\WireUi\Alert;

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
            Packs\Padding::BASE => 'pl-1 mt-2 ml-5',
        ];
    }
}
