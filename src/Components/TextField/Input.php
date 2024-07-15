<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\View\WireUiComponent;

class Input extends WireUiComponent
{
    use HasSetupForm;

    protected function blade(): View
    {
        return view('wireui-text-field::input');
    }
}
