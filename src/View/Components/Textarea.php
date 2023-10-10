<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class Textarea extends Component
{
    use IsFormComponent;

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
