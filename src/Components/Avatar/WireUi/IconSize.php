<?php

namespace WireUi\Components\Avatar\WireUi;

use WireUi\Support\ComponentPack;

class IconSize extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            '2xs' => [
                'icon'  => 'w-4 h-4',
                'label' => 'text-2xs',
            ],
            'xs' => [
                'icon'  => 'w-5 h-5',
                'label' => 'text-xs',
            ],
            'sm' => [
                'icon'  => 'w-6 h-6',
                'label' => 'text-sm',
            ],
            'md' => [
                'icon'  => 'w-7 h-7',
                'label' => 'text-base',
            ],
            'lg' => [
                'icon'  => 'w-8 h-8',
                'label' => 'text-lg',
            ],
            'xl' => [
                'icon'  => 'w-9 h-9',
                'label' => 'text-xl',
            ],
            '2xl' => [
                'icon'  => 'w-12 h-12',
                'label' => 'text-2xl',
            ],
        ];
    }
}
