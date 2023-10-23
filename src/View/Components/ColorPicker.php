<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};

class ColorPicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'shadowless' => false,
    ];

    public function __construct(
        public $rightIcon = 'swatch',
        public array|Collection $colors = [],
        public bool $colorNameAsValue = false,
    ) {
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

    protected function blade(): View
    {
        return view('wireui::components.color-picker');
    }
}
