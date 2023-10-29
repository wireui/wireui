<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class TimeSelector extends WireUiComponent
{
    protected function blade(): View
    {
        return view('wireui::components.time-selector');
    }
}
