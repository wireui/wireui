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
        public bool $withoutItemsCount = false,
        public string $rightIcon = 'selector',
        public ?string $icon = null,
        public ?string $label = null,
        public ?string $hint = null,
        public ?string $placeholder = null,
        public ?string $optionValue = null,
        public ?string $optionLabel = null,
        public ?string $optionDescription = null,
        public ?string $emptyMessage = null,
        public bool $hideEmptyMessage = false,
        public bool $flipOptions = false,
        public bool $optionKeyValue = false,
        public bool $alwaysFetch = false,
        public string|array|null $asyncData = null,
        public string|array|null $template = null,
        Collection|array|null $options = null,
        public ?int $minItemsForSearch = 11,
    ) {
        parent::__construct(
            label: $label,
            hint: $hint,
            placeholder: $placeholder,
            optionValue: $optionValue,
            optionLabel: $optionLabel,
            optionDescription: $optionDescription,
            emptyMessage: $emptyMessage,
            hideEmptyMessage: $hideEmptyMessage,
            flipOptions: $flipOptions,
            optionKeyValue: $optionKeyValue,
            options: $options,
        );

        if (gettype($template) === 'string') {
            $this->template = ['name' => $template];
        }

        if (gettype($asyncData) === 'string' || $asyncData === null) {
            $this->asyncData = [
                'api'         => $asyncData,
                'method'      => 'GET',
                'params'      => [],
                'alwaysFetch' => $this->alwaysFetch,
            ];
        }

        $this->ensureAsyncData();
        $this->validateConfig();
    }

    private function ensureAsyncData(): void
    {
        data_set($this->asyncData, 'method', data_get($this->asyncData, 'method', 'GET'));
        data_set($this->asyncData, 'params', data_get($this->asyncData, 'params', []));
    }

    private function validateConfig(): void
    {
        if ($this->options->isNotEmpty() && $this->asyncData['api']) {
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

    public function optionsToArray(): array
    {
        return $this->options
            ->map(function ($rawOption, $index): array {
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

                return array_filter($option, function ($value, $index) {
                    if (in_array($index, ['label', 'value'])) {
                        return true;
                    }

                    return (bool) $value;
                }, ARRAY_FILTER_USE_BOTH);
            })
            ->values()
            ->toArray();
    }
}
