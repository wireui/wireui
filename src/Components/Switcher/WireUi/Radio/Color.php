<?php

namespace WireUi\Components\Switcher\WireUi\Radio;

use Illuminate\Support\Arr;
use WireUi\Support\ComponentPack;

class Color extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.color') ?? 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => Arr::toCssClasses([
                'border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
            'secondary' => Arr::toCssClasses([
                'border-secondary-300 text-secondary-600 focus:ring-secondary-600 focus:border-secondary-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
            'positive' => Arr::toCssClasses([
                'border-secondary-300 text-positive-600 focus:ring-positive-600 focus:border-positive-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
            'negative' => Arr::toCssClasses([
                'border-secondary-300 text-negative-600 focus:ring-negative-600 focus:border-negative-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
            'warning' => Arr::toCssClasses([
                'border-secondary-300 text-warning-600 focus:ring-warning-600 focus:border-warning-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
            'info' => Arr::toCssClasses([
                'border-secondary-300 text-info-600 focus:ring-info-600 focus:border-info-400',
                'dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600',
                'dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600',
                'dark:focus:ring-offset-secondary-800',
            ]),
        ];
    }
}
