<?php

namespace WireUi\Traits\Customization;

trait HasSetupForm
{
    private array $sharedAttributes = ['id', 'name', 'readonly', 'disabled'];

    protected function setupForm(array &$component): void
    {
        $model = $this->data->wire('model')->value();

        if ($this->data->has('name') && !$model) {
            $model = $this->data->get('name');
        }

        if (!$this->data->has('name') && $model) {
            $this->data->offsetSet('name', $model);
        }

        if (!$this->data->has('id') && $model) {
            $this->data->offsetSet('id', md5($model));
        }

        collect($this->sharedAttributes)->each(function ($attribute) use (&$component) {
            $value = $this->data->get($attribute);

            $component[$attribute] = $value;

            $this->data->offsetSet($attribute, $value);
        });
    }
}
