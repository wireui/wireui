<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;
use WireUi\Components\Select\Traits\FilterOptions;
use WireUi\View\WireUiComponent;

class UserOption extends WireUiComponent
{
    use FilterOptions;

    protected array $props = [
        'src' => null,
        'label' => null,
        'option' => [],
        'description' => null,
    ];

    public function blade(): View
    {
        return view('wireui-select::user-option');
    }
}
