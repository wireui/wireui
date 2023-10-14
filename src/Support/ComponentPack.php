<?php

namespace WireUi\Support;

use WireUi\Exceptions\WireUiAttributeException;

abstract class ComponentPack
{
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

    private function checkAttribute(mixed $attribute): void
    {
        $attribute = $this->serializeAttribute($attribute);

        throw_if(!in_array($attribute, $this->keys()), new WireUiAttributeException($this));
    }

    private function getDefault(): mixed
    {
        $this->checkAttribute($this->default());

        return $this->get($this->default());
    }

    public function get(mixed $attribute = null): mixed
    {
        if (is_null($attribute) || $attribute === GLOBAL_STYLE) {
            return $this->getDefault();
        }

        $attribute = $this->serializeAttribute($attribute);

        return data_get($this->all(), $attribute) ?? $attribute;
    }

    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract protected function default(): string;

    abstract public function all(): array;
}
