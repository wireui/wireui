<?php

namespace WireUi\Components\Link\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Underline extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Underline::HOVER;
    }

    public function all(): array
    {
        return [
            Packs\Underline::ALWAYS => 'underline',
            Packs\Underline::NONE => 'no-underline',
            Packs\Underline::HOVER => 'no-underline hover:underline',
        ];
    }
}
