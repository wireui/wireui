<?php

namespace WireUi\Support\Buttons\Colors;

abstract class ColorPack
{
    public function get(?string $color): Color
    {
        if (!$color || $color === 'default') {
            return $this->default();
        }

        return data_get(
            target: $this->all(),
            key: $color,
            default: new Color($color)
        );
    }

    /** @return array<int, string> */
    public function keys(): array
    {
        return array_keys($this->all());
    }

    abstract public function default(): Color;

    /** @return array<string, Color> */
    abstract public function all(): array;
}
