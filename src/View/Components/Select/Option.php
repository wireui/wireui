<?php

namespace WireUi\View\Components\Select;

use Illuminate\View\Component;

class Option extends Component
{
    public function __construct(
        public bool $readonly = false,
        public bool $disabled = false,
        public mixed $value = null,
        public ?string $label = null,
        public ?string $description = null,
        public mixed $option = null
    ) {
    }

    public function render()
    {
        return view('wireui::components.select.option');
    }

    public function jsonOption(): string
    {
        return collect((array) $this->option)
            ->merge([
                'label'       => $this->label,
                'value'       => $this->value,
                'disabled'    => $this->disabled,
                'readonly'    => $this->readonly || $this->disabled,
                'description' => $this->description,
            ])
            ->filter()
            ->toJson();
    }
}
