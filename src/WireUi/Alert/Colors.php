<?php

namespace WireUi\WireUi\Alert;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.alert.color') ?? 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => [
                'icon'            => 'bell',
                'iconColor'       => 'text-primary-400 dark:text-primary-600',
                'textColor'       => 'text-primary-800 dark:text-primary-600',
                'borderColor'     => 'border-primary-200 dark:border-primary-600',
                'backgroundColor' => 'bg-primary-50 dark:bg-secondary-800',
            ],
            'positive' => [
                'icon'            => 'check-circle',
                'iconColor'       => 'text-positive-400 dark:text-positive-600',
                'textColor'       => 'text-positive-800 dark:text-positive-600',
                'borderColor'     => 'border-positive-200 dark:border-positive-600',
                'backgroundColor' => 'bg-positive-50 dark:bg-secondary-800',
            ],
            'negative' => [
                'icon'            => 'x-circle',
                'iconColor'       => 'text-negative-400 dark:text-negative-600',
                'textColor'       => 'text-negative-800 dark:text-negative-600',
                'borderColor'     => 'border-negative-200 dark:border-negative-600',
                'backgroundColor' => 'bg-negative-50 dark:bg-secondary-800',
            ],
            'warning' => [
                'icon'            => 'exclamation-triangle',
                'iconColor'       => 'text-warning-400 dark:text-warning-600',
                'textColor'       => 'text-warning-800 dark:text-warning-600',
                'borderColor'     => 'border-warning-200 dark:border-warning-600',
                'backgroundColor' => 'bg-warning-50 dark:bg-secondary-800',
            ],
            'info' => [
                'icon'            => 'information-circle',
                'iconColor'       => 'text-info-400 dark:text-info-600',
                'textColor'       => 'text-info-800 dark:text-info-600',
                'borderColor'     => 'border-info-200 dark:border-info-600',
                'backgroundColor' => 'bg-info-50 dark:bg-secondary-800',
            ],
        ];
    }
}
