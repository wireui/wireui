<?php

namespace WireUi\WireUi\Toggle;

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
            'xs' => 'icon xs',
            'sm' => 'icon sm',
            'md' => 'icon md',
            'lg' => 'icon lg',
            'xl' => 'icon xl',
        ];
    }
}
