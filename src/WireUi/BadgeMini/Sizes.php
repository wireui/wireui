<?php

namespace WireUi\WireUi\BadgeMini;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    protected function default(): string
    {
        return 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'w-6 h-6',
            'md' => 'w-7 h-7',
            'lg' => 'w-8 h-8',
        ];
    }
}
