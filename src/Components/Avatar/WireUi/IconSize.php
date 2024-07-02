<?php

namespace WireUi\Components\Avatar\WireUi;

use WireUi\Enum\Packs\Size;
use WireUi\Support\ComponentPack;

class IconSize extends ComponentPack
{
    protected function default(): string
    {
        return Size::MD;
    }

    public function all(): array
    {
        return [
            Size::XS2 => [
                'icon' => 'w-4 h-4',
                'label' => 'text-2xs',
            ],
            Size::XS => [
                'icon' => 'w-5 h-5',
                'label' => 'text-xs',
            ],
            Size::SM => [
                'icon' => 'w-6 h-6',
                'label' => 'text-sm',
            ],
            Size::MD => [
                'icon' => 'w-7 h-7',
                'label' => 'text-base',
            ],
            Size::LG => [
                'icon' => 'w-8 h-8',
                'label' => 'text-lg',
            ],
            Size::XL => [
                'icon' => 'w-9 h-9',
                'label' => 'text-xl',
            ],
            Size::XL2 => [
                'icon' => 'w-12 h-12',
                'label' => 'text-2xl',
            ],
        ];
    }
}
