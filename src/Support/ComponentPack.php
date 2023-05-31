<?php

namespace WireUi\Support;

use Exception;

abstract class ComponentPack
{
    protected function checkAttribute(string $attribute): void
    {
        throw_if(!in_array($attribute, $this->keys()), new Exception("Invalid {$this} provided."));
    }

    public function get(?string $attribute = null): mixed
    {
        if (is_null($attribute)) {
            return $this->default();
        }

        return data_get($this->all(), $attribute) ?? $this->default();
    }

    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract public function __toString(): string;

    abstract protected function default(): mixed;

    abstract public function all(): array;
}
