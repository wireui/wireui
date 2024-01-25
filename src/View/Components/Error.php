<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Error extends WireUiComponent
{
    protected array $props = [
        'name' => null,
    ];

    public function blade(): View
    {
        return view('wireui::components.error');
    }
}
