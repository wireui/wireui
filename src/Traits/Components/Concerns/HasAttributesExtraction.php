<?php

namespace WireUi\Traits\Components\Concerns;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;

trait HasAttributesExtraction
{
    protected function extractableAttributes(): array
    {
        return [];
    }

    protected function extractAttributes(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];

        foreach ($this->extractableAttributes() as $attribute) {
            $property = Str::camel($attribute);

            if ($attributes->missing($attribute) || array_key_exists($property, $data)) {
                continue;
            }

            $data[$property] = $attributes->get($attribute);

            $attributes->offsetUnset($attribute);
        }

        return $data;
    }
}
