<?php

namespace WireUi\Components\Alert\WireUi\Color;

use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.color') ?? 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => [
                'icon'       => 'bell',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-primary-600 dark:bg-primary-600',
            ],
            'secondary' => [
                'icon'       => 'information-circle',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-secondary-600 dark:bg-secondary-600',
            ],
            'positive' => [
                'icon'       => 'check-circle',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-positive-600 dark:bg-positive-600',
            ],
            'negative' => [
                'icon'       => 'x-circle',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-negative-600 dark:bg-negative-600',
            ],
            'warning' => [
                'icon'       => 'exclamation-triangle',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-warning-600 dark:bg-warning-600',
            ],
            'info' => [
                'icon'       => 'information-circle',
                'iconColor'  => 'text-white dark:text-black',
                'text'       => 'text-white dark:text-black',
                'background' => 'bg-info-600 dark:bg-info-600',
            ],
        ];
    }
}
