<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownHeader extends Component
{
    public string $classes;

    public function __construct(
        public ?string $label = null,
        public bool $separator = false,
    ) {
        $this->classes = $this->getClasses();
    }

    public function render(): View
    {
        return view('wireui::components.dropdown.header');
    }

    protected function getClasses(): string
    {
        return <<<'EOT'
            block pl-2 pt-2 pb-1 text-xs text-secondary-600 sticky top-0 bg-white
            dark:bg-secondary-800 dark:text-secondary-400
        EOT;
    }
}
