<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Input extends WireUiComponent
{
    use HasSetupWrapper;

    protected function blade(): View
    {
        return view('wireui-text-field::input');
    }
}
