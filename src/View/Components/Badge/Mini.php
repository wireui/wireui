<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Mini extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    protected array $packs = ['icon-size'];

    protected array $props = [
        'icon'       => null,
        'label'      => null,
        'iconless'   => false,
        'right-icon' => null,
    ];

    public function blade(): View
    {
        return view('wireui::components.badge.mini');
    }
}
