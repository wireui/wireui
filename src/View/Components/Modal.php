<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Modal extends WireUiComponent
{
    protected array $packs = ['align', 'blur', 'width', 'type'];

    protected array $props = [
        'id',
        'name',
        'spacing',
        'z-index',
        'blurless',
        'show' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.modal');
    }
}
