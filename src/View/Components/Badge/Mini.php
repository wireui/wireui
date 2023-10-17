<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Mini extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    protected array $booleans = ['iconless'];

    protected array $props = ['label', 'icon', 'right-icon'];

    public function blade(): View
    {
        return view('wireui::components.badge.mini');
    }
}
