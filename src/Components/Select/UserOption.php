<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;

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

    public function render(): View
    {
        return view('wireui-select::user-option');
    }
}
