<?php

namespace WireUi\WireUi\Alert\Colors;

use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
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
                'icon' => 'bell',
                'iconColor' => 'text-white dark:text-black',
                'textColor' => 'text-white dark:text-black',
                'borderColor' => '',
                'backgroundColor' => 'bg-primary-600 dark:bg-primary-600',
            ],
            'positive' => [
                'icon' => 'check-circle',
                'iconColor' => 'text-white dark:text-black',
                'textColor' => 'text-white dark:text-black',
                'borderColor' => '',
                'backgroundColor' => 'bg-positive-600 dark:bg-positive-600',
            ],
            'negative' => [
                'icon' => 'x-circle',
                'iconColor' => 'text-white dark:text-black',
                'textColor' => 'text-white dark:text-black',
                'borderColor' => '',
                'backgroundColor' => 'bg-negative-600 dark:bg-negative-600',
            ],
            'warning' => [
                'icon' => 'exclamation-triangle',
                'iconColor' => 'text-white dark:text-black',
                'textColor' => 'text-white dark:text-black',
                'borderColor' => '',
                'backgroundColor' => 'bg-warning-600 dark:bg-warning-600',
            ],
            'info' => [
                'icon' => 'information-circle',
                'iconColor' => 'text-white dark:text-black',
                'textColor' => 'text-white dark:text-black',
                'borderColor' => '',
                'backgroundColor' => 'bg-info-600 dark:bg-info-600',
            ],
        ];
    }
}
