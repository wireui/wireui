<?php

namespace WireUi\Traits;

trait HasModifiers
{
    protected function getMatchModifier(array $keys): ?string
    {
        $matches = $this->attributes->only($keys)->getAttributes();

        return array_key_first($matches);
    }
}
