<?php

namespace WireUi\Components\Alert\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
{
    protected function default(): string
    {
        return config('wireui.style.color') ?? Color::PRIMARY;
    }

    public function all(): array
    {
        return [
            Color::PRIMARY => [
                'icon' => 'bell',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-primary-600 dark:bg-primary-600',
            ],
            Color::SECONDARY => [
                'icon' => 'information-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-secondary-600 dark:bg-secondary-600',
            ],
            Color::POSITIVE => [
                'icon' => 'check-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-positive-600 dark:bg-positive-600',
            ],
            Color::NEGATIVE => [
                'icon' => 'x-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-negative-600 dark:bg-negative-600',
            ],
            Color::WARNING => [
                'icon' => 'exclamation-triangle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-warning-600 dark:bg-warning-600',
            ],
            Color::INFO => [
                'icon' => 'information-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-info-600 dark:bg-info-600',
            ],
            Color::BLUE => [
                'icon' => 'x-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-blue-600 dark:bg-blue-600',
            ],
            Color::EMERALD => [
                'icon' => 'check-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-emerald-600 dark:bg-emerald-600',
            ],
            Color::RED => [
                'icon' => 'x-circle',
                'iconColor' => 'text-white dark:text-black',
                'text' => 'text-white dark:text-black',
                'background' => 'bg-red-600 dark:bg-red-600',
            ],
        ];
    }
}
