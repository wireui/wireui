<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Textarea extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function except(): array
    {
        return ['icon', 'right-icon', 'prefix', 'suffix'];
    }

    protected function blade(): View
    {
        return view('wireui::components.textarea');
    }
}
