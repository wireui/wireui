<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WireUi\Traits\Components\IsFormComponent;

class Input extends Component
{
    use IsFormComponent;

    public function __construct(
        public ?string $label = null,
        public ?string $description = null,
        public ?string $corner = null,
        public ?string $icon = null,
        public ?string $rightIcon = null,
        public ?string $prefix = null,
        public ?string $suffix = null,
        public ?bool $invalidated = null,
        public bool $withValidationColors = false,
        public bool $errorless = false,
        public bool $borderless = false,
        public bool $shadowless = false,
    ) {
    }

    protected function blade(): View
    {
        return view('wireui::components.input');
    }
}
