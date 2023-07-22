<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
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
            'none' => 'toggle rounded none',
            'sm' => 'toggle rounded sm',
            'base' => 'toggle rounded',
            'md' => 'toggle rounded md',
            'lg' => 'toggle rounded lg',
            'xl' => 'toggle rounded xl',
            '2xl' => 'toggle rounded 2xl',
            '3xl' => 'toggle rounded 3xl',
            'full' => 'toggle rounded full',
        ];
    }
}
