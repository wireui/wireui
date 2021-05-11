<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    public bool $hasError;

    public ?string $label;

    public function __construct(bool $hasError = false, ?string $label = null)
    {
        $this->hasError = $hasError;
        $this->label    = $label;
    }

    public function render()
    {
        return view('wireui::components.label');
    }
}
