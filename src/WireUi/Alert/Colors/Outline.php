<?php

namespace WireUi\WireUi\Alert\Colors;

use WireUi\Support\ComponentPack;

class Outline extends ComponentPack
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
                'iconColor' => 'text-primary-800 dark:text-primary-600',
                'textColor' => 'text-primary-800 dark:text-primary-600',
                'borderColor' => 'border border-primary-600',
                'backgroundColor' => 'bg-transparent',
            ],
            'positive' => [
                'icon' => 'check-circle',
                'iconColor' => 'text-positive-800 dark:text-positive-600',
                'textColor' => 'text-positive-800 dark:text-positive-600',
                'borderColor' => 'border border-positive-600',
                'backgroundColor' => 'bg-transparent',
            ],
            'negative' => [
                'icon' => 'x-circle',
                'iconColor' => 'text-negative-800 dark:text-negative-600',
                'textColor' => 'text-negative-800 dark:text-negative-600',
                'borderColor' => 'border border-negative-600',
                'backgroundColor' => 'bg-transparent',
            ],
            'warning' => [
                'icon' => 'exclamation-triangle',
                'iconColor' => 'text-warning-800 dark:text-warning-600',
                'textColor' => 'text-warning-800 dark:text-warning-600',
                'borderColor' => 'border border-warning-600',
                'backgroundColor' => 'bg-transparent',
            ],
            'info' => [
                'icon' => 'information-circle',
                'iconColor' => 'text-info-800 dark:text-info-600',
                'textColor' => 'text-info-800 dark:text-info-600',
                'borderColor' => 'border border-info-600',
                'backgroundColor' => 'bg-transparent',
            ],
        ];
    }
}
