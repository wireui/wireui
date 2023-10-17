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

    protected array $booleans = ['iconless', 'borderless'];

    protected array $props = ['src', 'label', 'icon', 'right-icon'];

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
