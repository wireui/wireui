<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use WireUi\View\Components\WireUiComponent;

class Base extends WireUiComponent
{
    protected array $props = [
        'persistent' => false,
        'position'   => null,
    ];

    protected array $packs = ['width', 'height'];

    public function blade(): View
    {
        return view('wireui::components.dropdown.base');
    }
}
