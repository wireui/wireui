<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\Actions\Dialog as DialogAction;
use WireUi\Traits\Components\{HasSetupAlign, HasSetupBlur, HasSetupType, HasSetupWidth};

class Dialog extends WireUiComponent
{
    use HasSetupAlign;
    use HasSetupBlur;
    use HasSetupType;
    use HasSetupWidth;

    public string $dialog;

    public function __construct(
        string $id = null,
        public ?string $title = null,
        public ?string $zIndex = null,
        public ?string $spacing = null,
        public ?string $description = null,
    ) {
        $this->dialog = DialogAction::makeEventName($id);
        $this->zIndex  ??= config('wireui.modal.z-index');
        $this->spacing ??= config('wireui.modal.spacing');
    }

    public function blade(): View
    {
        return view('wireui::components.dialog');
    }
}
