<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    protected array $packs = ['width', 'height'];

    protected array $props = [
        'position'   => null,
        'persistent' => false,
    ];

    public function blade(): View
    {
        return view('wireui::components.dropdown.base');
    }
}
