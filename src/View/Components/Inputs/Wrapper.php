<?php

namespace WireUi\View\Components\Inputs;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Wrapper extends Component
{
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $label = null,
        public ?string $corner = null,
        public ?string $description = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public bool $disabled = false,
        public bool $readonly = false,
        public bool $validated = false,
        public bool $invalidated = false,
        public bool $errorless = false,
    ) {
    }

    public function render(): View
    {
        return view('wireui::components.inputs.wrapper');
    }
}
