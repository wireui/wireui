<?php

namespace WireUi\Components\Label;

use Illuminate\Contracts\View\View;
use WireUi\View\WireUiComponent;

class Description extends WireUiComponent
{
    protected array $props = [
        'text' => null,
    ];

    public function blade(): View
    {
        return view('wireui-label::description');
    }
}
