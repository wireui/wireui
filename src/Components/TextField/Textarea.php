<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\HasSetupWrapper;
use WireUi\View\WireUiComponent;

class Textarea extends WireUiComponent
{
    use HasSetupWrapper;

    protected array $props = [
        'cols' => 'auto',
        'rows' => 4,
    ];

    protected function exclude(): array
    {
        return ['type', 'autocomplete'];
    }

    protected function except(): array
    {
        return ['icon', 'right-icon', 'prefix', 'suffix'];
    }

    protected function blade(): View
    {
        return view('wireui-text-field::textarea');
    }
}
