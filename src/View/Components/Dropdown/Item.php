<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $icon = null,
        public ?string $label = null,
        public bool $separator = false,
    ) {
    }

    public function render(): View
    {
        return view('wireui::components.dropdown.item');
    }
}
