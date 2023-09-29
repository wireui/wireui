<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupForm;

class Textarea extends BaseComponent
{
    use HasSetupForm;

    protected function except(): array
    {
        return [
            'icon',
            'right-icon',
            'prefix',
            'suffix',
        ];
    }

    protected function blade(): View
    {
        return view('wireui::components.textarea');
    }
}
