<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\View\Component;

class DropdownItem extends Component
{
    public bool $separator;

    public ?string $label;

    public ?string $icon;

    public function __construct(
        bool $separator = false,
        ?string $label = null,
        ?string $icon = null
    ) {
        $this->separator = $separator;
        $this->label     = $label;
        $this->icon      = $icon;
    }

    public function render()
    {
        return view('wireui::components.dropdown.item');
    }

    public function getClasses(): string
    {
        $classes = 'text-gray-600 px-4 py-2 text-sm flex items-center cursor-pointer
                    transition-colors duration-150 hover:text-gray-900 hover:bg-gray-100';

        if ($this->separator) {
            $classes .= ' border-t border-gray-200';
        }

        return $classes;
    }
}
