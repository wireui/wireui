<?php

namespace WireUi\Components\Errors;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Single extends WireUiComponent
{
    protected array $props = [
        'name' => null,
    ];

    public function blade(): View
    {
        return view('wireui-errors::single');
    }
}
