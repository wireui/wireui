<?php

namespace WireUi\WireUi\Cards;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'primary';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'primary' => [
                'root'   => 'bg-white dark:bg-secondary-800',
                'footer' => 'bg-secondary-50 dark:bg-secondary-800',
                'text'   => 'text-secondary-700 dark:text-secondary-400',
                'border' => 'border-secondary-200 dark:border-secondary-600',
            ],
            // 'secondary' => [
            //     'root' => 'bg-white dark:bg-secondary-800',
            // ],
            // 'positive' => [
            //     'root' => 'bg-white dark:bg-secondary-800',
            // ],
            // 'negative' => [
            //     'root' => 'bg-white dark:bg-secondary-800',
            // ],
            // 'warning' => [
            //     'root' => 'bg-white dark:bg-secondary-800',
            // ],
            // 'info' => [
            //     'root' => 'bg-white dark:bg-secondary-800',
            // ],
        ];
    }
}
