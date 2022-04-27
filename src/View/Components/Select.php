<?php

namespace WireUi\View\Components;

use Illuminate\Support\Collection;

class Select extends NativeSelect
{
    public function __construct(
        public string $rightIcon = 'selector',
        public string $optionComponent = 'select.option',
        public bool $clearable = true,
        public bool $searchable = true,
        public bool $multiselect = false,
        public ?string $icon = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $optionValue = null,
        public ?string $optionLabel = null,
        public bool $flipOptions = false,
        public bool $optionKeyValue = false,
        Collection|array|null $options = null,
    ) {
        parent::__construct(
            $label,
            $placeholder,
            $optionValue,
            $optionLabel,
            $flipOptions,
            $optionKeyValue,
            $options,
        );
    }

    protected function getView(): string
    {
        return 'wireui::components.select';
    }

    public function optionsToJson(): string
    {
        return $this->options->map(function (mixed $rawOption, int $index) {
            $option = [
                'label' => $this->getOptionLabel($rawOption),
                'value' => $this->getOptionValue($index, $rawOption),
            ];

            if ($component = data_get($rawOption, 'component')) {
                $option['component'] = $component;
            }

            if (data_get($rawOption, 'disabled')) {
                $option['disabled'] = true;
            }

            if (data_get($rawOption, 'readonly') || data_get($rawOption, 'disabled')) {
                $option['readonly'] = true;
            }

            return $option;
        })->values()->toJson();
    }
}
