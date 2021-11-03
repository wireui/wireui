<?php

namespace WireUi\View\Components;

class NativeSelect extends FormComponent
{
    public ?string $label;

    public ?string $placeholder;

    public ?string $optionValue;

    public ?string $optionLabel;

    public bool $optionKeyLabel;

    public bool $optionKeyValue;

    /** @var Collection|array|null */
    public $options;

    /** @param Collection|array|null $options */
    public function __construct(
        ?string $label = null,
        ?string $placeholder = null,
        ?string $optionValue = null,
        ?string $optionLabel = null,
        bool $optionKeyLabel = false,
        bool $optionKeyValue = false,
        $options = null
    ) {
        $this->label          = $label;
        $this->placeholder    = $placeholder;
        $this->optionValue    = $optionValue;
        $this->optionLabel    = $optionLabel;
        $this->optionKeyLabel = $optionKeyLabel;
        $this->optionKeyValue = $optionKeyValue;
        $this->options        = $options;
    }

    protected function getView(): string
    {
        return 'wireui::components.native-select';
    }

    public function defaultClasses(): string
    {
        return 'form-select block w-full pl-3 pr-10 py-2 text-base sm:text-sm shadow-sm
                rounded-md border bg-white focus:ring-1 focus:outline-none
                dark:bg-secondary-800 dark:border-secondary-600 dark:text-secondary-400';
    }

    public function colorClasses(): string
    {
        return 'border-secondary-300 focus:ring-primary-500 focus:border-primary-500';
    }

    public function errorClasses(): string
    {
        return 'border-negative-400 focus:ring-negative-500 focus:border-negative-500 text-negative-500
                dark:border-negative-600 dark:text-negative-500';
    }

    public function getOptionValue($key, $option)
    {
        if ($this->optionKeyValue) {
            return $key;
        }

        return data_get($option, $this->optionValue);
    }

    public function getOptionLabel($key, $option)
    {
        if ($this->optionKeyLabel) {
            return $key;
        }

        return data_get($option, $this->optionLabel);
    }
}
