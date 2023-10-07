<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};

class Modal extends WireUiComponent
{
    use HasSetupAlign;
    use HasSetupBlur;
    use HasSetupMaxWidth;
    use HasSetupType;

    public function __construct(
        public bool $show = false,
        public ?string $name = null,
        public ?string $zIndex = null,
        public ?string $spacing = null,
    ) {
        $this->zIndex  ??= config('wireui.modal.z-index');
        $this->spacing ??= config('wireui.modal.spacing');
    }

    public function blade(): View
    {
        return view('wireui::components.modal');
    }
}
