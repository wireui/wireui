<?php

namespace WireUi\Components\Card\WireUi;

use WireUi\Enum\Packs;
use WireUi\Support\ComponentPack;

class Color extends ComponentPack
{
    protected function default(): string
    {
        return Packs\Color::BASE;
    }

    public function all(): array
    {
        return [
            Packs\Color::BASE => [
                'root' => 'bg-white dark:bg-secondary-800',
                'footer' => 'bg-secondary-50 dark:bg-secondary-800',
                'text' => 'text-secondary-700 dark:text-secondary-400',
                'border' => 'border-secondary-200 dark:border-secondary-600',
            ],
        ];
    }
}
