<?php

namespace WireUi\WireUi\Input;

use WireUi\Support\ComponentPack;

class Shadows extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return '';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'none'  => 'shadow-none',
            'sm'    => 'shadow-sm',
            'base'  => 'shadow',
            'md'    => 'shadow-md',
            'lg'    => 'shadow-lg',
            'xl'    => 'shadow-xl',
            '2xl'   => 'shadow-2xl',
            'inner' => 'shadow-inner',
        ];
    }
}
