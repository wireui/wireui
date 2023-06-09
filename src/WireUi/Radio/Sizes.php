<?php

namespace WireUi\WireUi\Radio;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
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
            'xs' => 'w-3 h-3',
            'sm' => 'w-4 h-4',
            'md' => 'w-5 h-5',
            'lg' => 'w-6 h-6',
            'xl' => 'w-7 h-7',
        ];
    }
}
