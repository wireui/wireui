<?php

namespace WireUi\WireUi\Cards;

use WireUi\Support\ComponentPack;

class Paddings extends ComponentPack
{
    protected function default(): string
    {
        return 'base';
    }

    public function all(): array
    {
        return [
            'base' => 'px-2 py-5 md:px-4',
        ];
    }
}
