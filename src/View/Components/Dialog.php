<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Actions\Dialog as DialogAction;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupBlur, HasSetupMaxWidth, HasSetupType};
use WireUi\WireUi\Modal\{Aligns, Blurs, MaxWidths, Types};

class Dialog extends BaseComponent
{
    use HasSetupAlign;
    use HasSetupBlur;
    use HasSetupMaxWidth;
    use HasSetupType;

    public string $dialog;

    public function __construct(
        string $id = null,
        public ?string $title = null,
        public ?string $zIndex = null,
        public ?string $spacing = null,
        public ?string $description = null,
    ) {
        $this->setBlurResolve(Blurs::class);
        $this->setTypeResolve(Types::class);
        $this->setAlignResolve(Aligns::class);
        $this->setMaxWidthResolve(MaxWidths::class);

        $this->dialog = DialogAction::makeEventName($id);
        $this->zIndex  ??= config('wireui.modal.z-index');
        $this->spacing ??= config('wireui.modal.spacing');
    }

    public function blade(): View
    {
        return view('wireui::components.dialog');
    }
}
