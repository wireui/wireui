<?php

namespace WireUi\Support\Alerts;

abstract class ConfigPack
{
    public function get(?string $value): Config
    {
        if (!$value || $value === 'default') {
            return $this->default();
        }

        return data_get(
            target: $this->all(),
            key: $value,
            default: new Config($value),
        );
    }

    /** @return array<int, string> */
    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract public function default(): Config;

    /** @return array<string, Config> */
    abstract public function all(): array;
}
