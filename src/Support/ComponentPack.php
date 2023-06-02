<?php

namespace WireUi\Support;

use Exception;

abstract class ComponentPack
{
    private function checkAttribute(string $attribute): void
    {
        throw_if(!in_array($attribute, $this->keys()), new Exception("Invalid {$this} provided."));
    }

    private function getDefault(): mixed
    {
        $this->checkAttribute($this->default());

        return $this->get($this->default());
    }

    public function get(mixed $attribute = null): mixed
    {
        if (is_null($attribute)) {
            return $this->getDefault();
        }

        return data_get($this->all(), $attribute) ?? $attribute;
    }

    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract protected function default(): string;

    abstract public function all(): array;

    public function __toString()
    {
        return static::class;
    }
}
