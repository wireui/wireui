<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use WireUi\Traits\Components\HasSetupForm;

class ColorPicker extends BaseComponent
{
    use HasSetupForm;

    public function __construct(
        public $rightIcon = 'swatch',
        public array|Collection $colors = [],
        public bool $colorNameAsValue = false,
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.color-picker');
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
