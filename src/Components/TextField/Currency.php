<?php

namespace WireUi\Components\TextField;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Currency extends WireUiComponent
{
    use InteractsWithWrapper;

    protected array $props = [
        'decimal' => '.',
        'precision' => 2,
        'thousands' => ',',
        'emit-formatted' => false,
    ];

    protected function exclude(): array
    {
        return ['x-on:blur'];
    }

    protected function include(): array
    {
        return [
            'cy',
            'id',
            'dusk',
            'x-on:',
            'readonly',
            'required',
            'placeholder',
            'autocomplete',
        ];
    }

    protected function blade(): View
    {
        return view('wireui-text-field::currency');
    }
}
