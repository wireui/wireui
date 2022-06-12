<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    public function __construct(
        public bool $hasError = false,
        public ?string $label = null
    ) {
    }

    public function render()
    {
        return view('wireui::components.label');
    }
}
