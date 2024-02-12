<?php

namespace WireUi\Components\Switcher\WireUi\Toggle;

use Illuminate\Support\Arr;
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
            Packs\Color::PRIMARY => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-primary-600 peer-focus:ring-primary-600',
                'group-focus:ring-primary-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
            Packs\Color::SECONDARY => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-secondary-600 peer-focus:ring-secondary-600',
                'group-focus:ring-secondary-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
            Packs\Color::POSITIVE => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-positive-600 peer-focus:ring-positive-600',
                'group-focus:ring-positive-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
            Packs\Color::NEGATIVE => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-negative-600 peer-focus:ring-negative-600',
                'group-focus:ring-negative-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
            Packs\Color::WARNING => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-warning-600 peer-focus:ring-warning-600',
                'group-focus:ring-warning-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
            Packs\Color::INFO => Arr::toCssClasses([
                'bg-secondary-200 peer-checked:bg-info-600 peer-focus:ring-info-600',
                'group-focus:ring-info-600 dark:group-focus:ring-secondary-600',
                'dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800',
                'dark:bg-secondary-600 dark:peer-checked:bg-secondary-700',
            ]),
        ];
    }
}
