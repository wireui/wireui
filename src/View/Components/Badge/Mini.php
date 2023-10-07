<?php

namespace WireUi\View\Components\Badge;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize, HasSetupVariant};
use WireUi\View\Components\WireUiComponent;

class Mini extends WireUiComponent
{
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;
    use HasSetupVariant;

    public function __construct(
        public ?string $label = null,
    ) {
        //
    }

    public function blade(): View
    {
        return view('wireui::components.badge.mini');
    }
}
