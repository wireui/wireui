<?php

namespace WireUi\Components\TimePicker;

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
        'right-icon' => 'clock',
        'military-time' => false,
        'without-seconds' => false,
    ];

    protected function blade(): View
    {
        return view('wireui-time-picker::picker');
    }
}
