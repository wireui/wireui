<?php

namespace WireUi\Components\ColorPicker;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\View\WireUiComponent;

class Picker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'colors' => [],
        'shadowless' => false,
        'right-icon' => 'swatch',
        'color-name-as-value' => false,
    ];

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
