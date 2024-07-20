<?php

namespace WireUi\Components\ColorPicker;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithColor;
use WireUi\Traits\Components\InteractsWithRounded;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Picker extends WireUiComponent
{
    use InteractsWithColor;
    use InteractsWithRounded;
    use InteractsWithWrapper;

    protected array $props = [
        'label' => null,
        'colors' => [],
        'right-icon' => 'swatch',
        'color-name-as-value' => false,
    ];

    protected function exclude(): array
    {
        return ['type', 'x-model', 'wire:model'];
    }

    public function getColors(): array
    {
        return collect($this->colors)->map(function ($color, $index) {
            return is_array($color) ? $color : [
                'name' => is_numeric($index) ? $color : $index,
                'value' => $color,
            ];
        })->values()->toArray();
    }

    public function blade(): View
    {
        return view('wireui-color-picker::picker');
    }
}
