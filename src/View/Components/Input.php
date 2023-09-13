<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class Input extends Component
{
    use IsFormComponent;

    protected function blade(): View
    {
        return view('wireui::components.input');
    }
}
