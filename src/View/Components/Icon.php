<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public ?string $style = null,
        public bool $solid = false,
        public bool $outline = false,
    ) {
        $this->style = $this->getStyle();
    }

    public function render()
    {
        return view('wireui::components.icon');
    }

    private function getStyle(): string
    {
        if ($this->style) {
            return $this->style;
        }

        if ($this->solid) {
            return 'solid';
        }

        if ($this->outline) {
            return 'outline';
        }

        return config('wireui.icons.style');
    }
}
