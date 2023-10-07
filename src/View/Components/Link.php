<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupButton, HasSetupColor, HasSetupSize, HasSetupUnderline};

class Link extends WireUiComponent
{
    use HasSetupButton;
    use HasSetupColor;
    use HasSetupSize;
    use HasSetupUnderline;

    public function __construct(
        public ?string $label = null,
    ) {
        //
    }

    public function blade(): View
    {
        return view('wireui::components.link');
    }
}
