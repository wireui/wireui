<?php

namespace WireUi\Traits\Components\Concerns;

use Illuminate\Support\Str;

trait HasAttributesExtraction
{
    protected function extractableAttributes(): array
    {
        return [];
    }

    protected function extractAttributes(array &$data): void
    {
        foreach ($this->extractableAttributes() as $attribute) {
            $property = Str::camel($attribute);

            if ($this->attributes->missing($attribute)) {
                if (!array_key_exists($property, $data) && !property_exists($this, $property)) {
                    $data[$property] = null;
                }

                continue;
            }

            $data[$property] = $this->attributes->get($attribute);

            $this->attributes->offsetUnset($attribute);
        }
    }
}
