<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIconSize, HasSetupRounded, HasSetupSize};

class Avatar extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;

    protected array $packs = ['border'];

    protected array $props = [
        'src',
        'icon',
        'label',
        'iconless',
        'right-icon',
        'borderless',
    ];

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
