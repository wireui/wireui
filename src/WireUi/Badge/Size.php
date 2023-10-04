<?php

namespace WireUi\WireUi\Badge;

use WireUi\Support\ComponentPack;

class Size extends ComponentPack
{
    protected function default(): string
    {
        return 'sm';
    }

    public function all(): array
    {
        return [
            'sm' => 'gap-x-1 text-xs font-semibold px-2.5 py-0.5',
            'md' => 'gap-x-1 text-sm font-semibold px-2.5 py-0.5',
            'lg' => 'gap-x-1 text-base font-semibold px-2.5 py-0.5',
        ];
    }
}
