<?php

namespace WireUi\View\Components\Select;

class UserOption extends Option
{
    public function __construct(
        public bool $readonly = false,
        public bool $disabled = false,
        public mixed $value = null,
        public ?string $label = null,
        public ?string $description = null,
        public mixed $option = null,
        public ?string $src = null,
    ) {
    }

    public function render()
    {
        return view('wireui::components.select.user-option');
    }
}
