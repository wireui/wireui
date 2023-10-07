<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupBorder, HasSetupColor, HasSetupIcon, HasSetupIconSize, HasSetupRounded, HasSetupSize};

class Avatar extends WireUiComponent
{
    use HasSetupBorder;
    use HasSetupColor;
    use HasSetupIcon;
    use HasSetupIconSize;
    use HasSetupRounded;
    use HasSetupSize;

    public function __construct(
        public ?string $src = null,
        public ?string $label = null,
    ) {
        //
    }

    public function blade(): View
    {
        return view('wireui::components.avatar');
    }
}
