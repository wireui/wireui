<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;
use WireUi\Components\Select\Traits\FilterOptions;
use WireUi\View\WireUiComponent;

class Option extends WireUiComponent
{
    use FilterOptions;

    protected array $props = [
        'value' => null,
        'label' => null,
        'option' => [],
        'disabled' => false,
        'readonly' => false,
        'description' => null,
    ];

    public function blade(): View
    {
        return view('wireui-select::option');
    }
}
