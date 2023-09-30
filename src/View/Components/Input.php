<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;

class Input extends BaseComponent
{
    use HasSetupWrapper;

    protected function blade(): View
    {
        return view('wireui::components.input');
    }
}
