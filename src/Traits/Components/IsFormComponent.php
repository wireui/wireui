<?php

namespace WireUi\Traits\Components;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use WireUi\Support\WrapperData;

trait IsFormComponent
{
    use InteractsWithErrors;

    protected function except(): array
    {
        return [];
    }

    protected function sharedAttributes(): array
    {
        return WrapperData::shared();
    }

    protected function extractableAttributes(): array
    {
        return WrapperData::extractable();
    }

    protected function finished(array &$data): void
    {
        $data = $this->mergeAttributes($data);

        $data = $this->extractAttributes($data);

        $data['attrs'] = $data['attributes'];

        $data['wrapperData'] = (new WrapperData($data))->except($this->except());
    }

    protected function extractAttributes(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];

        foreach ($this->extractableAttributes() as $attribute) {
            $property = Str::camel($attribute);

            if ($attributes->missing($attribute)) {
                if (!array_key_exists($property, $data) && !property_exists($this, $property)) {
                    $data[$property] = null;
                }

                continue;
            }

            $data[$property] = $attributes->get($attribute);

            $attributes->offsetUnset($attribute);
        }

        return $data;
    }

    protected function mergeAttributes(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];

        $this->injectModel($attributes);

        foreach ($this->sharedAttributes() as $attribute) {
            $property = Str::camel($attribute);

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
        /** @var ?string $model */
        $model = $attributes->wire('model')->value();

        /** @var ?string $name */
        $name = $attributes->get('name', $model);

        if ($attributes->missing('name') && $model) {
            $attributes->offsetSet('name', $model);
        }

        if ($attributes->missing('id') && $name) {
            $attributes->offsetSet('id', $name);
        }
    }
}
