<?php

namespace WireUi\View\Components;

use Exception;
use Illuminate\Support\Collection;

class NativeSelect extends FormComponent
{
    private const PRIMITIVE_VALUES = [
        'string',
        'integer',
        'double',
        'boolean',
        'NULL',
    ];

    public Collection $options;

    public function __construct(
        public ?string $label = null,
        public ?string $placeholder = null,
        public ?string $optionValue = null,
        public ?string $optionLabel = null,
        public bool $flipOptions = false,
        Collection|array|null $options = null,
    ) {
        $this->options = collect($options);

        $this->validateConfig();
    }

    /**
     * Validate if the select options is set correctly.
     * @return void
     * @throws Exception
     */
    private function validateConfig(): void
    {
        if (($this->optionValue && !$this->optionLabel) || (!$this->optionValue && $this->optionLabel)) {
            throw new Exception('The {option-value} and {option-label} attributes must be set together.');
        }

        if ($this->flipOptions && $this->optionValue && $this->optionLabel) {
            throw new Exception('The {flip-options} attribute cannot be used with {option-value} and {option-label} attributes.');
        }

        if (
            !($this->optionValue && $this->optionLabel)
            && !in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new Exception(
                'Inform the {option-value} and {option-label} to use array, model, or object option.'
                    . '<x-select [...] option-value="id" option-label="name" />'
            );
        }

        if (
            ($this->optionValue && $this->optionLabel)
            && in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new Exception(
                'The {option-value} and {option-label} attributes cannot be used with primitive options values: '
                    . implode(', ', self::PRIMITIVE_VALUES)
            );
        }
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

    public function getOptionValue(int|string $key, mixed $option): mixed
    {
        if (!$this->flipOptions && !$this->optionValue) {
            return $key;
        }

        return data_get($option, $this->optionValue);
    }

    public function getOptionLabel(int|string $key, mixed $option): mixed
    {
        if ($this->flipOptions) {
            return $key;
        }

        return data_get($option, $this->optionLabel);
    }
}
