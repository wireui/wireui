<?php

namespace WireUi\WireUi\Alert\Colors;

use WireUi\Support\ComponentPack;

class Flat extends ComponentPack
{
    protected function default(): string
    {
        return 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => [
                'icon'       => 'bell',
                'iconColor'  => 'text-primary-800 dark:text-primary-200',
                'text'       => 'text-primary-800 dark:text-primary-200',
                'background' => 'bg-primary-50 dark:bg-primary-900/70',
            ],
            'positive' => [
                'icon'       => 'check-circle',
                'iconColor'  => 'text-positive-800 dark:text-positive-200',
                'text'       => 'text-positive-800 dark:text-positive-200',
                'background' => 'bg-positive-50 dark:bg-positive-900/70',
            ],
            'negative' => [
                'icon'       => 'x-circle',
                'iconColor'  => 'text-negative-800 dark:text-negative-200',
                'text'       => 'text-negative-800 dark:text-negative-200',
                'background' => 'bg-negative-50 dark:bg-negative-900/70',
            ],
            'warning' => [
                'icon'       => 'exclamation-triangle',
                'iconColor'  => 'text-warning-800 dark:text-warning-200',
                'text'       => 'text-warning-800 dark:text-warning-200',
                'background' => 'bg-warning-50 dark:bg-warning-900/70',
            ],
            'info' => [
                'icon'       => 'information-circle',
                'iconColor'  => 'text-info-800 dark:text-info-200',
                'text'       => 'text-info-800 dark:text-info-200',
                'background' => 'bg-info-50 dark:bg-info-900/70',
            ],
        ];
    }
}
