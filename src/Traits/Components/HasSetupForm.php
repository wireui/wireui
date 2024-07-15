<?php

namespace WireUi\Traits\Components;

trait HasSetupForm
{
    protected function setupForm(array &$data): void
    {
        $this->injectModel();

        $this->mergeAttributes($data);

        $data['wrapper'] = clone $this->attributes;
    }

    private function formAttributes(): array
    {
        return ['id', 'name', 'value', 'disabled', 'readonly'];
    }

    private function getValue(mixed $name): mixed
    {
        $value = $this->attributes->get('value');

        return $name ? old($name, $value) : $value;
    }

    private function mergeAttributes(array &$data): void
    {
        collect($this->formAttributes())->each(function (string $attribute) use (&$data) {
            $value = $this->attributes->get($attribute);

            $this->{$attribute} = $value;

            data_set($data, $attribute, $value);
        });
    }

    private function injectModel(): void
    {
        /** @var string|null $model */
        $model = $this->attributes->wire('model')->value();

        if (! $model) {
            /** @var Attribute|null $xModel */
            $xModel = $this->attributes->attribute('x-model');

            $model = $xModel?->expression();
        }

        /** @var ?string $name */
        $name = $this->attributes->get('name', $model);

        if ($this->attributes->missing('id') && $name) {
            $this->attributes->offsetSet('id', $name);
        }

        if ($this->attributes->missing('name') && $model) {
            $this->attributes->offsetSet('name', $model);
        }

        if ($this->attributes->missing('disabled') && $name) {
            $this->attributes->offsetSet('disabled', false);
        }

        if ($this->attributes->missing('readonly') && $name) {
            $this->attributes->offsetSet('readonly', false);
        }

        $this->attributes->offsetSet('value', $this->getValue($name));
    }
}