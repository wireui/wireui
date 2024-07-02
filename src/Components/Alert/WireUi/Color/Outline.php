<?php

namespace WireUi\Components\Alert\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Outline extends ComponentPack
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
                'iconColor' => 'text-primary-800 dark:text-primary-600',
                'text' => 'text-primary-800 dark:text-primary-600',
                'border' => 'border border-primary-600',
                'background' => 'bg-transparent',
            ],
            Color::SECONDARY => [
                'icon' => 'information-circle',
                'iconColor' => 'text-secondary-800 dark:text-secondary-600',
                'text' => 'text-secondary-800 dark:text-secondary-600',
                'border' => 'border border-secondary-600',
                'background' => 'bg-transparent',
            ],
            Color::POSITIVE => [
                'icon' => 'check-circle',
                'iconColor' => 'text-positive-800 dark:text-positive-600',
                'text' => 'text-positive-800 dark:text-positive-600',
                'border' => 'border border-positive-600',
                'background' => 'bg-transparent',
            ],
            Color::NEGATIVE => [
                'icon' => 'x-circle',
                'iconColor' => 'text-negative-800 dark:text-negative-600',
                'text' => 'text-negative-800 dark:text-negative-600',
                'border' => 'border border-negative-600',
                'background' => 'bg-transparent',
            ],
            Color::WARNING => [
                'icon' => 'exclamation-triangle',
                'iconColor' => 'text-warning-800 dark:text-warning-600',
                'text' => 'text-warning-800 dark:text-warning-600',
                'border' => 'border border-warning-600',
                'background' => 'bg-transparent',
            ],
            Color::INFO => [
                'icon' => 'information-circle',
                'iconColor' => 'text-info-800 dark:text-info-600',
                'text' => 'text-info-800 dark:text-info-600',
                'border' => 'border border-info-600',
                'background' => 'bg-transparent',
            ],
        ];
    }
}
