<?php

namespace WireUi\View\Components\Select;

use Illuminate\View\Component;

class Option extends Component
{
    public bool $readonly;

    public bool $disabled;

    public ?string $label;

    public ?string $value;

    public $option;

    /** @param array|string|null $option */
    public function __construct(
        bool $readonly = false,
        bool $disabled = false,
        ?string $label = null,
        ?string $value = null,
        $option = null
    ) {
        $this->readonly = $readonly;
        $this->disabled = $disabled;
        $this->label    = $label;
        $this->value    = $value;
        $this->option   = $option;
    }

    public function render()
    {
        return view('wireui::components.select.option');
    }
}
