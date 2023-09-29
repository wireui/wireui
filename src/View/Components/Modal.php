<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths, Types};

class Modal extends BaseComponent
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
        $this->setBlurResolve(Blurs::class);
        $this->setTypeResolve(Types::class);
        $this->setAlignResolve(Aligns::class);
        $this->setMaxWidthResolve(MaxWidths::class);

        $this->zIndex  ??= config('wireui.modal.z-index');
        $this->spacing ??= config('wireui.modal.spacing');
    }

    public function blade(): View
    {
        return view('wireui::components.modal');
    }
}
