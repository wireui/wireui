<?php

namespace WireUi\Components\Switcher;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupColor;
use WireUi\Traits\Components\HasSetupRounded;
use WireUi\Traits\Components\HasSetupSize;
use WireUi\Traits\Components\IsFormComponent;
use WireUi\View\WireUiComponent;

class Radio extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use IsFormComponent;

    protected array $props = [
        'label' => null,
        'left-label' => null,
        'description' => null,
    ];

    protected function blade(): View
    {
        return view('wireui-switcher::radio');
    }
}
