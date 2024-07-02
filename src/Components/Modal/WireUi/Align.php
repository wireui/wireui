<?php

namespace WireUi\Components\Modal\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Align extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Align::START;
    }

    public function all(): array
    {
        return [
            Packs\Align::START => 'sm:items-start',
            Packs\Align::CENTER => 'sm:items-center',
            Packs\Align::END => 'sm:items-end',
        ];
    }
}
