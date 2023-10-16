<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupHeight, HasSetupWidth};
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    use HasSetupAlign;
    use HasSetupHeight;
    use HasSetupWidth;

    public function __construct(
        public ?string $trigger = null,
        public bool $persistent = false,
    ) {
        //
    }

    public function blade(): View
    {
        return view('wireui::components.dropdown.base');
    }
}
