<?php

namespace WireUi\Components\Select\Traits;

trait FilterOptions
{
    public function toArray(): array
    {
        $option = collect([
            'label' => $this->label,
            'value' => $this->value,
            'disabled' => $this->disabled,
            'description' => $this->description,
            'readonly' => $this->readonly || $this->disabled,
        ])->merge((array) $this->option);

        return $option->filter(function ($value, $index) {
            if (in_array($index, ['label', 'value'])) {
                return $value !== null;
            }

            return (bool) $value;
        })->toArray();
    }
}
