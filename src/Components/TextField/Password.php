<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Password extends WireUiComponent
{
    use HasSetupWrapper;

    public function blade(): View
    {
        return view('wireui-text-field::password');
    }
}
