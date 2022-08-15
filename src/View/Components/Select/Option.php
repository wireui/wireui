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
        public mixed $option = []
    ) {
    }

    public function render()
    {
        return view('wireui::components.select.option');
    }

    public function toArray(): array
    {
        $option = array_merge((array) $this->option, [
            'label'       => $this->label,
            'value'       => $this->value,
            'disabled'    => $this->disabled,
            'readonly'    => $this->readonly || $this->disabled,
            'description' => $this->description,
        ]);

        return array_filter($option, function ($value, $index) {
            if (in_array($index, ['label', 'value'])) {
                return $value !== null;
            }

            return (bool) $value;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
