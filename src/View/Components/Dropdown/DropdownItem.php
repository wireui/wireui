<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Support\{Str, Stringable};
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
        return Str::of('text-secondary-600 px-4 py-2 text-sm flex items-center cursor-pointer rounded-md')
            ->append(' transition-colors duration-150 hover:text-secondary-900 hover:bg-secondary-100')
            ->append(' dark:text-secondary-400 dark:hover:bg-secondary-700');
    }
}
