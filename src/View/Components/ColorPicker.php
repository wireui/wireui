<?php

namespace WireUi\View\Components;

use Illuminate\Support\Collection;

class ColorPicker extends FormComponent
{
    public function __construct(
        public $rightIcon = 'color-swatch',
        public array|Collection $colors = [],
        public ?string $label = null,
        public bool $colorNameAsValue = false,
    ) {
    }

    protected function getView(): string
    {
        return 'wireui::components.color-picker';
    }

    public function getColors(): array
    {
        return collect($this->colors)
            ->map(function (string|array $color, string|int $index) {
                if (is_array($color)) {
                    return $color;
                }

                if (is_numeric($index)) {
                    $index = $color;
                }

                return [
                    'name'  => $index,
                    'value' => $color,
                ];
            })
            ->values()
            ->toArray();
    }
}
