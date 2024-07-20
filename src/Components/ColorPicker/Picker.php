<?php

namespace WireUi\Components\ColorPicker;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Picker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupWrapper;

    protected array $props = [
        'label' => null,
        'colors' => [],
        'right-icon' => 'swatch',
        'color-name-as-value' => false,
    ];

    protected function exclude(): array
    {
        return ['type', 'wire:model'];
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
