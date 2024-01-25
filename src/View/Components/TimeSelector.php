<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupRounded, IsFormComponent};
use WireUi\View\WireUiComponent;

class TimeSelector extends WireUiComponent
{
    use HasSetupRounded;
    use IsFormComponent;

    protected array $props = [
        'military-time'   => false,
        'without-seconds' => false,
        'borderless'      => false,
        'squared'         => false,
        'shadowless'      => false,
    ];

    protected function blade(): View
    {
        return view('wireui::components.time-selector');
    }
}
