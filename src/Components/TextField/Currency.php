<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Currency extends WireUiComponent
{
    use HasSetupWrapper;

    protected array $props = [
        'decimal' => '.',
        'precision' => 2,
        'thousands' => ',',
        'emit-formatted' => false,
    ];

    protected function include(): array
    {
        return ['cy', 'dusk', 'disabled', 'readonly', 'required', 'placeholder'];
    }

    protected function blade(): View
    {
        return view('wireui-text-field::currency');
    }
}
