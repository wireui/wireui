<?php

namespace WireUi\Components\Alert\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Flat extends ComponentPack
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
                'iconColor' => 'text-primary-800 dark:text-primary-200',
                'text' => 'text-primary-800 dark:text-primary-200',
                'background' => 'bg-primary-50 dark:bg-primary-900/70',
            ],
            Color::SECONDARY => [
                'icon' => 'information-circle',
                'iconColor' => 'text-secondary-800 dark:text-secondary-200',
                'text' => 'text-secondary-800 dark:text-secondary-200',
                'background' => 'bg-secondary-50 dark:bg-secondary-900/70',
            ],
            Color::POSITIVE => [
                'icon' => 'check-circle',
                'iconColor' => 'text-positive-800 dark:text-positive-200',
                'text' => 'text-positive-800 dark:text-positive-200',
                'background' => 'bg-positive-50 dark:bg-positive-900/70',
            ],
            Color::NEGATIVE => [
                'icon' => 'x-circle',
                'iconColor' => 'text-negative-800 dark:text-negative-200',
                'text' => 'text-negative-800 dark:text-negative-200',
                'background' => 'bg-negative-50 dark:bg-negative-900/70',
            ],
            Color::WARNING => [
                'icon' => 'exclamation-triangle',
                'iconColor' => 'text-warning-800 dark:text-warning-200',
                'text' => 'text-warning-800 dark:text-warning-200',
                'background' => 'bg-warning-50 dark:bg-warning-900/70',
            ],
            Color::INFO => [
                'icon' => 'information-circle',
                'iconColor' => 'text-info-800 dark:text-info-200',
                'text' => 'text-info-800 dark:text-info-200',
                'background' => 'bg-info-50 dark:bg-info-900/70',
            ],
        ];
    }
}
