<?php

namespace WireUi\Components\Card\WireUi;

use WireUi\Support\ComponentPack;

class Rounded extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.rounded') ?? 'base';
    }

    public function all(): array
    {
        return [
            'none' => [
                'root'   => 'rounded-none',
                'header' => 'rounded-t-none',
                'footer' => 'rounded-b-none',
            ],
            'sm' => [
                'root'   => 'rounded-sm',
                'header' => 'rounded-t-sm',
                'footer' => 'rounded-b-sm',
            ],
            'base' => [
                'root'   => 'rounded',
                'header' => 'rounded-t',
                'footer' => 'rounded-b',
            ],
            'md' => [
                'root'   => 'rounded-md',
                'header' => 'rounded-t-md',
                'footer' => 'rounded-b-md',
            ],
            'lg' => [
                'root'   => 'rounded-lg',
                'header' => 'rounded-t-lg',
                'footer' => 'rounded-b-lg',
            ],
            'xl' => [
                'root'   => 'rounded-xl',
                'header' => 'rounded-t-xl',
                'footer' => 'rounded-b-xl',
            ],
            '2xl' => [
                'root'   => 'rounded-2xl',
                'header' => 'rounded-t-2xl',
                'footer' => 'rounded-b-2xl',
            ],
            '3xl' => [
                'root'   => 'rounded-3xl',
                'header' => 'rounded-t-3xl',
                'footer' => 'rounded-b-3xl',
            ],
            'full' => [
                'root'   => 'rounded-3xl',
                'header' => 'rounded-t-3xl',
                'footer' => 'rounded-b-3xl',
            ],
        ];
    }
}
