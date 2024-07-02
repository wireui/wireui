<?php

namespace WireUi\Components\Wrapper\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Color extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.color') ?? Packs\Color::PRIMARY;
    }

    public function all(): array
    {
        return [
            Packs\Color::PRIMARY => [
                'input' => 'focus-within:ring-primary-600',
                'prepend' => 'input-focus:text-primary-500',
                'append' => 'input-focus:text-primary-500',
            ],
            Packs\Color::SECONDARY => [
                'input' => 'focus-within:ring-secondary-600',
                'prepend' => 'input-focus:text-secondary-500',
                'append' => 'input-focus:text-secondary-500',
            ],
            Packs\Color::POSITIVE => [
                'input' => 'focus-within:ring-positive-600',
                'prepend' => 'input-focus:text-positive-500',
                'append' => 'input-focus:text-positive-500',
            ],
            Packs\Color::NEGATIVE => [
                'input' => 'focus-within:ring-negative-600',
                'prepend' => 'input-focus:text-negative-500',
                'append' => 'input-focus:text-negative-500',
            ],
            Packs\Color::WARNING => [
                'input' => 'focus-within:ring-warning-600',
                'prepend' => 'input-focus:text-warning-500',
                'append' => 'input-focus:text-warning-500',
            ],
            Packs\Color::INFO => [
                'input' => 'focus-within:ring-info-600',
                'prepend' => 'input-focus:text-info-500',
                'append' => 'input-focus:text-info-500',
            ],
        ];
    }
}
