<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;

class Modal extends WireUiComponent
{
    protected array $packs = ['align', 'blur', 'width', 'type'];

    protected array $props = [
        'id'         => null,
        'name'       => null,
        'show'       => false,
        'spacing'    => null,
        'z-index'    => null,
        'blurless'   => false,
        'persistent' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.modal');
    }
}
