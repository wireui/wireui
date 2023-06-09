<?php

namespace WireUi\WireUi\Badge\Sizes;

use WireUi\Support\ComponentPack;

class Base extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'sm';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'sm' => 'gap-x-1 text-xs font-semibold px-2.5 py-0.5',
            'md' => 'gap-x-1 text-sm font-semibold px-2.5 py-0.5',
            'lg' => 'gap-x-1 text-base font-semibold px-2.5 py-0.5',
        ];
    }
}
