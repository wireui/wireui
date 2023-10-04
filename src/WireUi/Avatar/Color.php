<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Support\ComponentPack;

class Color extends ComponentPack
{
    protected function default(): string
    {
        return 'secondary';
    }

    public function all(): array
    {
        return [
            'primary' => [
                'label'  => 'bg-primary-500 dark:bg-primary-600',
                'border' => 'border-primary-200 dark:border-primary-500',
            ],
            'secondary' => [
                'label'  => 'bg-secondary-500 dark:bg-secondary-600',
                'border' => 'border-secondary-200 dark:border-secondary-500',
            ],
            'positive' => [
                'label'  => 'bg-positive-500 dark:bg-positive-600',
                'border' => 'border-positive-200 dark:border-positive-500',
            ],
            'negative' => [
                'label'  => 'bg-negative-500 dark:bg-negative-600',
                'border' => 'border-negative-200 dark:border-negative-500',
            ],
            'warning' => [
                'label'  => 'bg-warning-500 dark:bg-warning-600',
                'border' => 'border-warning-200 dark:border-warning-500',
            ],
            'info' => [
                'label'  => 'bg-info-500 dark:bg-info-600',
                'border' => 'border-info-200 dark:border-info-500',
            ],
        ];
    }
}
