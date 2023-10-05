<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupMaxHeight, HasSetupMaxWidth};
use WireUi\View\Components\WireUiComponent;
use WireUi\WireUi\Dropdown\{Align, Height, Width};

class Base extends WireUiComponent
{
    use HasSetupAlign;
    use HasSetupMaxHeight;
    use HasSetupMaxWidth;

    public function __construct(
        string $width = null,
        string $height = null,
        public ?string $trigger = null,
        public bool $persistent = false,
    ) {
        $this->maxWidth  = $width;
        $this->maxHeight = $height;

        $this->setAlignResolve(Align::class);
        $this->setMaxWidthResolve(Width::class);
        $this->setMaxHeightResolve(Height::class);
    }

    public function blade(): View
    {
        return view('wireui::components.dropdown.base');
    }
}
