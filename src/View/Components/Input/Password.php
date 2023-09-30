<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\Components\WireUiComponent;

class Password extends WireUiComponent
{
    use HasSetupWrapper;

    public function blade(): View
    {
        return view('wireui::components.input.password');
    }
}
