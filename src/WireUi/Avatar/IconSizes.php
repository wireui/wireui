<?php

namespace WireUi\WireUi\Avatar;

use WireUi\Support\ComponentPack;

class IconSizes extends ComponentPack
{
    protected function default(): string
    {
        return 'md';
    }

    public function all(): array
    {
        return [
            'xs' => [
                'icon'  => 'w-4 h-4',
                'label' => 'text-2xs',
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
            '3xl' => [
                'icon'  => 'w-16 h-16',
                'label' => 'text-3xl',
            ],
        ];
    }
}
