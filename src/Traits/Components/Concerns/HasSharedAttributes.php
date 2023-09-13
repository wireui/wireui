<?php

namespace WireUi\Traits\Components\Concerns;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;

trait HasSharedAttributes
{
    protected function sharedAttributes(): array
    {
        return [];
    }

    protected function mergeAttributes(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];

        $this->injectModel($attributes);

        foreach ($this->sharedAttributes() as $attribute) {
            $property = Str::camel($attribute);

            if ($attributes->missing($attribute) && !property_exists($this, $property)) {
                continue;
            }

            $value = property_exists($this, $property)
                ? data_get($this, $property)
                : $attributes->get($attribute);

            $data[$property] = $value;
            $attributes->offsetSet($attribute, $value);
        }

        return $data;
    }

    private function injectModel(ComponentAttributeBag $attributes): void
    {
        /** @var string|null $model */
        $model = $attributes->wire('model')->value();

        if ($attributes->has('name') && !$model) {
            $model = $attributes->get('name');
        }

        if (!$attributes->has('name') && $model) {
            $attributes->offsetSet('name', $model);
        }

        if (!$attributes->has('id') && $model) {
            $attributes->offsetSet('id', $model);
        }
    }
}
