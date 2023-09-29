<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\HasSetupForm;

class Input extends Component
{
    use HasSetupForm;

    protected function blade(): View
    {
        return view('wireui::components.input');
    }
}
