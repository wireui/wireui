<?php

namespace WireUi\View\Components;

use Exception;
use Illuminate\Support\Collection;

class Select extends NativeSelect
{
    public function __construct(
        public bool $clearable = true,
        public bool $searchable = true,
        public bool $multiselect = false,
        public string $rightIcon = 'selector',
        public ?string $icon = null,
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $optionValue = null,
        public ?string $optionLabel = null,
        public ?string $optionDescription = null,
        public ?string $emptyMessage = null,
        public ?string $asyncData = null,
        public bool $flipOptions = false,
        public bool $optionKeyValue = false,
        public string|array|null $template = null,
        Collection|array|null $options = null,
    ) {
        parent::__construct(
            $label,
            $placeholder,
            $optionValue,
            $optionLabel,
            $optionDescription,
            $flipOptions,
            $optionKeyValue,
            $options,
        );

        if (gettype($template) === 'string') {
            $this->template = ['name' => $template];
        }

        $this->validateConfig();
    }

    private function validateConfig(): void
    {
        if ($this->options->isNotEmpty() && $this->asyncData) {
            throw new Exception('The {async-data} attribute cannot be used with {options} attribute.');
        }
    }

    protected function getView(): string
    {
        return 'wireui::components.select';
    }

    public function getOptionLabel(mixed $option): string
    {
        return data_get($option, $this->optionLabel);
    }

    public function optionsToJson(): string
    {
        return $this->options
            ->map(function (mixed $rawOption, int $index) {
                $option = [
                    'label'       => $this->getOptionLabel($rawOption),
                    'value'       => $this->getOptionValue($index, $rawOption),
                    'template'    => data_get($rawOption, 'template'),
                    'disabled'    => data_get($rawOption, 'disabled'),
                    'readonly'    => data_get($rawOption, 'readonly') || data_get($rawOption, 'disabled'),
                    'description' => $this->getOptionDescription($rawOption),
                ];

                if ($this->optionValue) {
                    $option = array_merge((array) $rawOption, $option);
                }

                if ($this->optionValue && $this->optionValue !== 'value') {
                    unset($option[$this->optionValue]);
                }

                if ($this->optionLabel && $this->optionLabel !== 'label') {
                    unset($option[$this->optionLabel]);
                }

                if ($this->optionDescription && $this->optionDescription !== 'description') {
                    unset($option[$this->optionDescription]);
                }

                return array_filter($option);
            })
            ->values()
            ->toJson();
    }
}
