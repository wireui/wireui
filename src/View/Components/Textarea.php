<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;

class Textarea extends WireUiComponent
{
    use HasSetupWrapper;

    protected function except(): array
    {
        return ['icon', 'right-icon', 'prefix', 'suffix'];
    }

    protected function blade(): View
    {
        return view('wireui::components.textarea');
    }
}
