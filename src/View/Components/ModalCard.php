<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class ModalCard extends WireUiComponent
{
    protected array $props = [
        'hide-close' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.modal-card');
    }
}
