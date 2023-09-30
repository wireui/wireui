<?php

namespace WireUi\WireUi\Wrapper;

use WireUi\Support\ComponentPack;

class Rounders extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.wrapper.rounded') ?? 'md';
    }

    public function all(): array
    {
        return [
            'none' => [
                'input'   => 'rounded-none',
                'prepend' => 'rounded-none',
                'append'  => 'rounded-none',
            ],
            'sm' => [
                'input'   => 'rounded-sm',
                'prepend' => 'rounded-l-sm',
                'append'  => 'rounded-r-sm',
            ],
            'base' => [
                'input'   => 'rounded',
                'prepend' => 'rounded-l',
                'append'  => 'rounded-r',
            ],
            'md' => [
                'input'   => 'rounded-md',
                'prepend' => 'rounded-l-md',
                'append'  => 'rounded-r-md',
            ],
            'lg' => [
                'input'   => 'rounded-lg',
                'prepend' => 'rounded-l-lg',
                'append'  => 'rounded-r-lg',
            ],
            'xl' => [
                'input'   => 'rounded-xl',
                'prepend' => 'rounded-l-xl',
                'append'  => 'rounded-r-xl',
            ],
            '2xl' => [
                'input'   => 'rounded-2xl',
                'prepend' => 'rounded-l-2xl',
                'append'  => 'rounded-r-2xl',
            ],
            '3xl' => [
                'input'   => 'rounded-3xl',
                'prepend' => 'rounded-l-3xl',
                'append'  => 'rounded-r-3xl',
            ],
            'full' => [
                'input'   => 'rounded-full',
                'prepend' => 'rounded-l-full',
                'append'  => 'rounded-r-full',
            ],
        ];
    }
}
