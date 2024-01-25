<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize};
use WireUi\View\WireUiComponent;

class Checkbox extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use IsFormComponent;

    protected array $props = [
        'label'       => null,
        'left-label'  => null,
        'description' => null,
    ];

    protected function blade(): View
    {
        return view('wireui::components.checkbox');
    }
}
