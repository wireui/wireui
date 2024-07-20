<?php

namespace WireUi\Components\TimePicker;

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
        'right-icon' => 'clock',
        'military-time' => false,
        'without-seconds' => false,
    ];

    protected function include(): array
    {
        return ['cy', 'dusk', 'disabled', 'readonly', 'required', 'placeholder'];
    }

    protected function blade(): View
    {
        return view('wireui-time-picker::picker');
    }
}
