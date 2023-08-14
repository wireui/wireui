<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Header extends Component
{
    public function __construct(
        public ?string $label = null,
        public bool $separator = false,
    ) {
    }

    public function getSeparatorClasses(): string
    {
        return Arr::toCssClasses([
            'border-t border-secondary-200 dark:border-secondary-600' => $this->separator,
        ]);
    }

    public function getLabelClasses(): string
    {
        return Arr::toCssClasses([
            'block pl-2 pt-2 pb-1 text-xs text-secondary-600 sticky top-0 bg-white',
            'dark:bg-secondary-800 dark:text-secondary-400',
        ]);
    }

    public function render(): View
    {
        return view('wireui::components.dropdown.header');
    }
}
