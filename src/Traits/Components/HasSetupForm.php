<?php

namespace WireUi\Traits\Components;

trait HasSetupForm
{
    private array $sharedAttributes = ['id', 'name', 'readonly', 'disabled'];

    protected function setupForm(array &$data): void
    {
        $model = $this->attributes->wire('model')->value();

        if ($this->attributes->has('name') && !$model) {
            $model = $this->attributes->get('name');
        }

        if (!$this->attributes->has('name') && $model) {
            $this->attributes->offsetSet('name', $model);
        }

        if (!$this->attributes->has('id') && $model) {
            $this->attributes->offsetSet('id', $model);
        }

        collect($this->sharedAttributes)->each(function ($attribute) use (&$data) {
            $value = $this->attributes->get($attribute);

            $data[$attribute] = $value;

            $this->attributes->offsetSet($attribute, $value);
        });
    }
}
