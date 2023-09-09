<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Item extends Component
{
    public function __construct(
        public ?string $icon = null,
        public ?string $label = null,
        public bool $separator = false,
    ) {
    }

    public function getLabelClasses(): string
    {
        return Arr::toCssClasses([
            'text-secondary-600 px-4 py-2 text-sm flex items-center cursor-pointer rounded-md',
            'transition-colors duration-150 hover:text-secondary-900 hover:bg-secondary-100',
            'dark:text-secondary-400 dark:hover:bg-secondary-700',
        ]);
    }

    public function render(): View
    {
        return view('wireui::components.dropdown.item');
    }
}
