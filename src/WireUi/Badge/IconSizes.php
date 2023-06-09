<?php

namespace WireUi\WireUi\Badge;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
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
            'sm' => 'w-3 h-3',
            'md' => 'w-4 h-4',
            'lg' => 'w-5 h-5',
        ];
    }
}
