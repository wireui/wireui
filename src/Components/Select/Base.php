<?php

namespace WireUi\Components\Select;

use Illuminate\Contracts\View\View;
use WireUi\Attributes\Process;
use WireUi\Components\Select\Traits\CheckOptions;
use WireUi\Traits\Components\InteractsWithWrapper;
use WireUi\View\WireUiComponent;

class Base extends WireUiComponent
{
    use CheckOptions;
    use InteractsWithWrapper;

    protected array $props = [
        'label' => null,
        'options' => null,
        'template' => null,
        'clearable' => true,
        'async-data' => null,
        'right-icon' => 'chevron-up-down',
        'searchable' => true,
        'multiselect' => false,
        'placeholder' => null,
        'always-fetch' => false,
        'flip-options' => false,
        'option-label' => null,
        'option-value' => null,
        'empty-message' => null,
        'option-key-value' => false,
        'hide-empty-message' => false,
        'option-description' => null,
        'without-items-count' => true,
        'min-items-for-search' => 11,
    ];

    protected function except(): array
    {
        return ['label'];
    }

    #[Process()]
    protected function process(): void
    {
        $this->serializeOptions();

        if (gettype($this->template) === 'string') {
            $this->template = ['name' => $this->template];
        }

        if (gettype($this->asyncData) === 'string' || $this->asyncData === null) {
            $this->asyncData = [
                'api' => $this->asyncData,
                'method' => 'GET',
                'params' => [],
                'alwaysFetch' => $this->alwaysFetch,
            ];
        }

        $this->ensureAsyncData();

        $this->validateConfig();
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
                    'label' => $this->getOptionLabel($rawOption),
                    'value' => $this->getOptionValue($index, $rawOption),
                    'template' => data_get($rawOption, 'template'),
                    'disabled' => data_get($rawOption, 'disabled'),
                    'readonly' => data_get($rawOption, 'readonly') || data_get($rawOption, 'disabled'),
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

    private function ensureAsyncData(): void
    {
        data_set($this->asyncData, 'method', data_get($this->asyncData, 'method', 'GET'));

        data_set($this->asyncData, 'params', data_get($this->asyncData, 'params', []));
    }

    protected function blade(): View
    {
        return view('wireui-select::base');
    }
}
