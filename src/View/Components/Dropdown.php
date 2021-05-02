<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Dropdown extends Component
{
    public const DEFAULT_ALIGN = 'right';

    public string $width;

    public string $align;

    public ?string $trigger;

    public bool $persistent;

    public function __construct(
        string $width = 'w-48',
        string $align = self::DEFAULT_ALIGN,
        bool $persistent = false,
        ?string $trigger = null
    ) {
        $this->width      = $width;
        $this->align      = $align;
        $this->persistent = $persistent;
        $this->trigger    = $trigger;
    }

    public function render()
    {
        return view('wireui::components.dropdown');
    }

    public function getAlign(): string
    {
        $alignments = [
            'right' => 'origin-top-right right-0',
            'left'  => 'origin-top-left left-0',
        ];

        return $alignments[$this->align];
    }
}
