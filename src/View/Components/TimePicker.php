<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded};
use WireUi\View\WireUiComponent;

class TimePicker extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use IsFormComponent;

    protected array $packs = ['shadow'];

    protected array $props = [
        'right-icon'      => 'clock',
        'shadowless'      => false,
        'military-time'   => false,
        'without-seconds' => false,
    ];

    protected function blade(): View
    {
        return view('wireui::components.time-picker');
    }
}
