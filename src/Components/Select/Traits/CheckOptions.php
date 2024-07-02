<?php

namespace WireUi\Components\Select\Traits;

use Illuminate\Support\Collection;
use InvalidArgumentException;

trait CheckOptions
{
    public const PRIMITIVE_VALUES = ['string', 'integer', 'double', 'boolean', 'NULL'];

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

    private function serializeOptions(): void
    {
        $this->options = collect($this->options)->when(
            $this->flipOptions,
            fn (Collection $collection) => $collection->flip(),
        );
    }

    /**
     * Validate if the select options is set correctly.
     *
     * @throws InvalidArgumentException
     */
    private function validateConfig(): void
    {
        if (! $this->optionKeyValue && (($this->optionValue && ! $this->optionLabel) || (! $this->optionValue && $this->optionLabel))) {
            throw new InvalidArgumentException('Invalid configuration: Both {option-value} and {option-label} are required when {option-key-value} is false.');
        }

        if ($this->flipOptions && ($this->optionValue || $this->optionLabel)) {
            throw new InvalidArgumentException('Invalid configuration: {flip-options} should not be used with {option-value} or {option-label}.');
        }

        if (property_exists($this, 'asyncData') && $this->options->isNotEmpty() && $this->asyncData['api']) {
            throw new InvalidArgumentException('Invalid configuration: Asynchronous data (asyncData) is set, but the "api" key is missing or empty in the asyncData array.');
        }

        if (
            (! $this->optionValue && (! $this->optionLabel || ($this->optionKeyValue && ! $this->optionLabel)))
            && $this->options->isNotEmpty()
            && ! in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new InvalidArgumentException('Invalid configuration: When {option-value} is not set, either {option-label} or {option-key-value} should be provided.');
        }

        if (
            ($this->optionValue && $this->optionLabel)
            && $this->options->isNotEmpty()
            && in_array(gettype($this->options->first()), self::PRIMITIVE_VALUES, true)
        ) {
            throw new InvalidArgumentException('Invalid configuration: When both {option-value} and {option-label} are set, options should be an array of objects, not primitive values.');
        }
    }
}
