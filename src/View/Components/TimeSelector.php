<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class TimeSelector extends WireUiComponent
{
    protected array $props = [
        'format'        => 'HH:mm:ss',
        'military-time' => false,
        'disabled'      => false,
        'readonly'      => false,
    ];

    protected function blade(): View
    {
        return view('wireui::components.time-selector');
    }
}
