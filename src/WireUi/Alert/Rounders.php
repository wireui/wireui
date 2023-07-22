<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'lg';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'none' => 'rounded-none',
            'sm' => 'rounded-sm',
            'base' => 'rounded',
            'md' => 'rounded-md',
            'lg' => 'rounded-lg',
            'xl' => 'rounded-xl',
            '2xl' => 'rounded-2xl',
            'full' => 'rounded-3xl',
        ];
    }
}
