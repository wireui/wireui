<?php

namespace WireUi\Components\Card\WireUi;

use WireUi\Support\ComponentPack;

class Padding extends ComponentPack
{
    protected function default(): string
    {
        return 'medium';
    }

    public function all(): array
    {
        return [
            'none'   => 'p-0',
            'small'  => 'px-1 py-3 md:px-2',
            'medium' => 'px-2 py-5 md:px-4',
            'large'  => 'px-3 py-6 md:px-5',
        ];
    }
}
