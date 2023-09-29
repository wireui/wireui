<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;
use WireUi\View\Components\BaseComponent;

class PasswordInput extends BaseComponent
{
    use HasSetupForm;

    public function blade(): View
    {
        return view('wireui::components.input.password');
    }
}
