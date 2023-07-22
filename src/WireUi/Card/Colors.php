<?php

namespace WireUi\WireUi\Card;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
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
            'base' => [
                'root' => 'bg-white dark:bg-secondary-800',
                'footer' => 'bg-secondary-50 dark:bg-secondary-800',
                'text' => 'text-secondary-700 dark:text-secondary-400',
                'border' => 'border-secondary-200 dark:border-secondary-600',
            ],
        ];
    }
}
