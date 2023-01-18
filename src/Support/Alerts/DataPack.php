<?php

namespace WireUi\Support\Alerts;

abstract class DataPack
{
    public function get(?string $value): Data
    {
        if (!$value || $value === 'default') {
            return $this->default();
        }

        return data_get(
            target: $this->all(),
            key: $value,
            default: new Data($value),
        );
    }

    /** @return array<int, string> */
    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract public function default(): Data;

    /** @return array<string, Data> */
    abstract public function all(): array;
}
