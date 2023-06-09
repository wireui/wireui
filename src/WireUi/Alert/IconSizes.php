<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'base';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'base' => 'w-5 h-5 mr-3 shrink-0',
        ];
    }
}
