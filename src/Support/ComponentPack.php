<?php

namespace WireUi\Support;

use Exception;

abstract class ComponentPack
{
    /**
     * Serialize attributes when they are boolean to be compatible with version 1.
     */
    private function serializeAttribute(mixed $attribute): mixed
    {
        if (is_bool($attribute) && $attribute) {
            return '1';
        }

        if (is_bool($attribute) && !$attribute) {
            return '0';
        }

        return $attribute;
    }

    /**
     * Check if the attribute is valid.
     */
    private function checkAttribute(mixed $attribute): void
    {
        $attribute = $this->serializeAttribute($attribute);

        throw_if(!in_array($attribute, $this->keys()), new Exception("Invalid {$this} provided."));
    }

    /**
     * Get the value to default option.
     */
    private function getDefault(): mixed
    {
        $this->checkAttribute($this->default());

        return $this->get($this->default());
    }

    /**
     * Get the value of given attribute.
     */
    public function get(mixed $attribute = null): mixed
    {
        if (is_null($attribute)) {
            return $this->getDefault();
        }

        $attribute = $this->serializeAttribute($attribute);

        return data_get($this->all(), $attribute) ?? $attribute;
    }

    /**
     * Get all options.
     */
    public function keys(): array
    {
        return array_keys($this->all());
    }

    /**
     * Return the default option.
     */
    abstract protected function default(): string;

    /**
     * Return all options.
     */
    abstract public function all(): array;

    /**
     * Return the class name.
     */
    public function __toString()
    {
        return static::class;
    }
}
