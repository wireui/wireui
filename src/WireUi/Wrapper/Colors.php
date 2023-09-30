<?php

namespace WireUi\WireUi\Wrapper;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.wrapper.color') ?? 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => [
                'input'   => 'focus-within:ring-primary-600',
                'prepend' => 'input-focus:text-primary-500',
                'append'  => 'input-focus:text-primary-500',
            ],
            'secondary' => [
                'input'   => 'focus-within:ring-secondary-600',
                'prepend' => 'input-focus:text-secondary-500',
                'append'  => 'input-focus:text-secondary-500',
            ],
            'positive' => [
                'input'   => 'focus-within:ring-positive-600',
                'prepend' => 'input-focus:text-positive-500',
                'append'  => 'input-focus:text-positive-500',
            ],
            'negative' => [
                'input'   => 'focus-within:ring-negative-600',
                'prepend' => 'input-focus:text-negative-500',
                'append'  => 'input-focus:text-negative-500',
            ],
            'warning' => [
                'input'   => 'focus-within:ring-warning-600',
                'prepend' => 'input-focus:text-warning-500',
                'append'  => 'input-focus:text-warning-500',
            ],
            'info' => [
                'input'   => 'focus-within:ring-info-600',
                'prepend' => 'input-focus:text-info-500',
                'append'  => 'input-focus:text-info-500',
            ],
        ];
    }
}
