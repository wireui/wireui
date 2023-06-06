<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Sizes extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.toggle.size') ?? 'sm';
    }

    public function all(): array
    {
        return [
            'xs' => [
                'background' => 'h-4 w-7',
                'circle'     => 'checked:translate-x-3 w-3 h-3',
            ],
            'sm' => [
                'background' => 'h-4 w-7',
                'circle'     => 'checked:translate-x-3 w-3 h-3',
            ],
            'md' => [
                'background' => 'h-5 w-9',
                'circle'     => 'checked:translate-x-3.5 left-0.5 w-3.5 h-3.5',
            ],
            'lg' => [
                'background' => 'h-6 w-10',
                'circle'     => 'checked:translate-x-4 left-0.5 w-4 h-4',
            ],
            'xl' => [
                'background' => 'h-4 w-7',
                'circle'     => 'checked:translate-x-3 w-3 h-3',
            ],
        ];
    }
}
