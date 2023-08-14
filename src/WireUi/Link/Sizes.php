<?php

namespace WireUi\WireUi\Link;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            'sm' => 'text-sm',
            'md' => 'text-base',
            'lg' => 'text-lg',
        ];
    }
}
