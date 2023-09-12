<?php

namespace WireUi\View\Components\Dropdown;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Base extends Component
{
    public const DEFAULT_ALIGN = 'right';

    public function __construct(
        public string $width = 'w-48',
        public string $height = 'max-h-60',
        public string $align = self::DEFAULT_ALIGN,
        public bool $persistent = false,
        public ?string $trigger = null,
    ) {
    }

    public function render(): View
    {
        return view('wireui::components.dropdown.index');
    }

    public function getAlign(): string
    {
        $alignments = [
            'right'     => 'origin-top-right right-0',
            'left'      => 'origin-top-left left-0',
            'top-right' => 'origin-top-right right-0 bottom-0',
            'top-left'  => 'origin-top-left left-0 bottom-0',
        ];

        return $alignments[$this->align];
    }
}
