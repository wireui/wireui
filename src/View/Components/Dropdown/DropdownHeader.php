<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\View\Component;

class DropdownHeader extends Component
{
    public bool $separator;

    public ?string $label;

    public function __construct(bool $separator = false, ?string $label = null)
    {
        $this->separator = $separator;
        $this->label     = $label;
    }

    public function render()
    {
        return view('wireui::components.dropdown.header');
    }
}
