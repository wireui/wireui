<?php

namespace WireUi\Traits\Components\Concerns;

use Illuminate\Support\Str;

trait HasSharedAttributes
{
    protected function sharedAttributes(): array
    {
        return [];
    }

    protected function mergeAttributes(array &$data): void
    {
        $this->injectModel();

        foreach ($this->sharedAttributes() as $attribute) {
            $property = Str::camel($attribute);

            $value = property_exists($this, $property)
                ? data_get($this, $property)
                : $this->attributes->get($attribute);

            $data[$property] = $value;

            $this->attributes->offsetSet($attribute, $value);
        }
    }

    private function injectModel(): void
    {
        /** @var ?string $model */
        $model = $this->attributes->wire('model')->value();

        /** @var ?string $name */
        $name = $this->attributes->get('name', $model);

        if ($this->attributes->missing('name') && $model) {
            $this->attributes->offsetSet('name', $model);
        }

        if ($this->attributes->missing('id') && $name) {
            $this->attributes->offsetSet('id', $name);
        }
    }
}
