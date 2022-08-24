<?php

namespace WireUi\View\Components;

use Illuminate\Support\Collection;
use InvalidArgumentException;

class NativeSelect extends FormComponent
{
    public const PRIMITIVE_VALUES = [
        'string',
        'integer',
        'double',
        'boolean',
        'NULL',
    ];

    public Collection $options;

    public function __construct(
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
        Collection|array|null $options = null,
    ) {
        $this->options = collect($options)->when(
            $flipOptions,
            fn (Collection $collection) => $collection->flip()
        );

        $this->validateConfig();
    }

    /**
     * Validate if the select options is set correctly.
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateConfig(): void
    {
        if (!$this->optionKeyValue && (($this->optionValue && !$this->optionLabel) || (!$this->optionValue && $this->optionLabel))) {
            throw new InvalidArgumentException('The {option-value} and {option-label} attributes must be set together.');
        }

        if ($this->flipOptions && ($this->optionValue || $this->optionLabel)) {
            throw new InvalidArgumentException('The {flip-options} attribute cannot be used with {option-value} and {option-label} attributes.');
        }

        if (
            (!$this->optionValue && (!$this->optionLabel || ($this->optionKeyValue && !$this->optionLabel)))
            && $this->options->isNotEmpty()
            && !in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new InvalidArgumentException(
                'Inform the {option-value} and {option-label} to use array, model, or object option.'
                    . ' <x-select [...] option-value="id" option-label="name" />'
            );
        }

        if (
            ($this->optionValue && $this->optionLabel)
            && $this->options->isNotEmpty()
            && in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new InvalidArgumentException(
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
        if ($this->optionKeyValue) {
            return $key;
        }

        return data_get($option, $this->optionValue);
    }

    public function getOptionLabel(mixed $option): ?string
    {
        $label = data_get($option, $this->optionLabel);

        if ($this->optionDescription || data_get($option, 'description')) {
            return "{$label} - {$this->getOptionDescription($option)}";
        }

        return $label;
    }

    public function getOptionDescription(mixed $option): ?string
    {
        if ($this->optionDescription) {
            return data_get($option, $this->optionDescription);
        }

        return data_get($option, 'description');
    }
}
